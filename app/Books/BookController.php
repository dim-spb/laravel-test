<?php
namespace App\Books;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


use App\DBHelper;
use Session;
 
class BookController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->table = 'books';
        $this->per_page = 5;
        $this->upload_path = '/public/books/';

        // extra-params for template builder
        $this->blade_params = [
            'js_css_ver' => time() // 2025-02-01_1
        ];
        return $this;
    }

    public function build_table(): View {
        $f_name = trim(request('f_name',''));
        $f_author = trim(request('f_author','')); 

        $rows = DB::table($this->table)
            ->when($f_name, function($q, String $f_name) { return $q->where('name', 'like', '%'.$f_name.'%'); })
            ->when($f_author, function($q, String $f_author) { return $q->where('author', 'like', '%'.$f_author.'%'); })
            ->orderBy('id')
            ->paginate($this->per_page)->withQueryString();

        $params = $this->blade_params + [
             'title' => 'Список книг'
            ,'f_name' => $f_name
            ,'f_author' => $f_author
            ,'books' => $rows
        ];

        return view('index', $params);
    }

    public function build_editor(int $book_id = null): View {
        $book = $this->book_row($book_id);
        $title = ($book) ? 'Редактирование книги #'.$book_id : 'Добавление новой книги';
    
        $params = $this->blade_params + [
             'title' => $title
            ,'book' => $book ? $book : \App\DBHelper::table_defaults($this->table)
        ];

        return view('edit', $params);
    }

    private function validate_form(Request $request) {
        $rules = [
             'name' => 'required|max:255'
            ,'author' => 'required|max:255'
            ,'y' => 'required|numeric|min:1500|max:'.date("Y")
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            Session::flash('error-message', "Ошибки при валидации формы!");
        }

        $validated = $validator->validated();

        return $validated;
    }

    public function show_cover(int $book_id) {
        $book = $this->book_row($book_id);
        $cover = $this->upload_path.$book['cover'];

        if (!$cover || !Storage::exists($cover)) {
            abort(404);
        }
        $file = Storage::get($cover);
        $mime = Storage::mimeType($cover);
        return response($file, 200)->header('Content-Type', $mime);
    }

    private function upload_cover(Request $request) : String {
        $new_basename = '';
        if ($request->isMethod('post')) {
            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $tmpname = $file->getPathName();
                $filename = $file->getClientOriginalName();
                $fileinfo = pathinfo($filename);
                // не хватает проверки хотя бы на mime =(
                $ext = $fileinfo['extension'];
                $new_basename = md5($filename.time()).'.'.$ext;

                Storage::putFileAs($this->upload_path, $file, $new_basename);
            }
        }
        return $new_basename;
    }

    private function delete_prev_cover(string $filename) {
        Storage::delete($this->upload_path . $filename);
    }

    public function save(Request $request, int $book_id) : RedirectResponse {
        $fields = [
            'name' => request('name',''),
            'author' => request('author',''),
            'y' => request('y',''),
        ];

        Session::flash('posted_fields',$fields);
        
        if ($this->validate_form($request)) {
            // проверить что значения изменились?
            $book = $this->book_row($book_id);

            $new_cover = $this->upload_cover($request);
            if ($new_cover) $fields['cover'] = $new_cover;

            if ($book) {
                if ($new_cover) {
                    $this->delete_prev_cover($book['cover']);
                }
                
                // update
                DB::table($this->table)
                    ->where('id', $book_id)
                    ->update($fields);

                Session::flash('info-message', "Данные успешно обновлены!");
            } else {
                // insert 
                $book_id = DB::table($this->table)
                    ->insertGetId($fields);

                Session::flash('info-message', "Данные успешно добавлены!");
            }
        }

        return to_route('call_editor', ['id' => $book_id]);
    }

    public function delete(int $book_id) : RedirectResponse {
        $book = $this->book_row($book_id);
        if ($book) {
            if ($book['cover']) {
                $this->delete_prev_cover($book['cover']);
            }

            // update
            DB::table($this->table)
                ->where('id', $book_id)
                ->delete();

            Session::flash('info-message', "Запись успешно удалена!");
        }

        return to_route('build_table');
    }

    private function book_row(int $book_id = null) {
        $book = DB::table($this->table)->where('id',$book_id)->get()->toArray();

        return $book ? (array)$book[0] : false; 
    }

    
}