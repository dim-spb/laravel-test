<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::dropIfExists('books');
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 255);
            $table->string('author', length: 255);
            $table->string('cover', length: 255)->nullable();
            $table->integer('y');
            $table->timestamps();
        });

        // наполнение тестовыми данными

        $test_data = [
             ['name'=>'Книга1','author'=>'Иванов И.И.','y'=>1967,'cover'=>'00d70dddbf5b1654654db6f6643e1ed3.jpg']
            ,['name'=>'Книга2','author'=>'Петров П.П.','y'=>1951,'cover'=>'1cb57c8552dfaccdfce676c65c4719fb.jpg']
            ,['name'=>'Книга3','author'=>'Петров П.П.','y'=>1997,'cover'=>'5b300af7cb89e14b3b3804b63d38f6d5.jpg']
            ,['name'=>'Книга4','author'=>'Иванов И.И.','y'=>2020,'cover'=>'d37166e40b7c6968e88487ce25300a59.jpg']
            ,['name'=>'Книга5','author'=>'Петров П.П.','y'=>1977,'cover'=>'86b3092097d21db0bd224278cf2b7e28.jpg']
            ,['name'=>'Книга6','author'=>'Алексеев А.П.','y'=>1952,'cover'=>'a468d1ffde63011671f2efbcda09064e.jpg']
            ,['name'=>'Книга7','author'=>'Иванов П.П.','y'=>2011,'cover'=>'']
            ,['name'=>'Книга8','author'=>'Иванов П.П.','y'=>2010,'cover'=>'']
            ,['name'=>'Книга9','author'=>'Иванов П.П.','y'=>1992,'cover'=>'']
            ,['name'=>'Книга10','author'=>'Андреев А.А.','y'=>1997,'cover'=>'']
            ,['name'=>'Книга11','author'=>'Дмитриев П.П.','y'=>1917,'cover'=>'']
            ,['name'=>'Книга12','author'=>'Алексеев А.А.','y'=>1937,'cover'=>'']
            ,['name'=>'Книга13','author'=>'Иванов В.В.','y'=>1987,'cover'=>'']
            ,['name'=>'Книга14','author'=>'Сидоров В.В.','y'=>1997,'cover'=>'']
        ];

        DB::table('books')->insert($test_data);
    }

    public function down(): void {
        Schema::dropIfExists('books');
    }
};
