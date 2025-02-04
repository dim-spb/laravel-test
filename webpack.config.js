const path = require('path');

module.exports = [
    {
        mode: 'production',
        entry: './resources/js/jquery-3.7.1.min.js',
        output: {
            filename: 'jquery.min.js',
            path: path.resolve(__dirname, 'public/js'),
        },
    },
    {
        mode: 'production',
        entry: './resources/js/main.js',
        output: {
            filename: 'main.min.js',
            path: path.resolve(__dirname, 'public/js'),
        },
    },
    {
        module: {
            rules: [
                {
                    test: /\.css$/i,
                    use: ["style-loader","css-loader"],
                },
            ],
        },

        optimization: {
            minimize: true
        },

        mode: 'production',
        entry: './resources/css/main.css',
        output: {
            filename: 'style.min.js',
            path: path.resolve(__dirname, 'public/js'),
        },
    }
];