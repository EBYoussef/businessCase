const CopyPlugin = require('copy-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
        index: './src/app/controllers/index.js',
        details: './src/app/controllers/details.js'
    },
    devServer: {
        contentBase: './dist/views',
        hot: true,
        liveReload: true,
        open: true
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                        plugins: [
                            "@babel/plugin-proposal-class-properties"
                        ]
                    }
                }
            },
            {
                test: /\.css$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader']
            }
        ]
    },
    plugins: [
        new CopyPlugin({
            patterns: [
                {
                    from: 'assets/images',
                    to: './assets/images'
                }
            ]
        }),
        new HtmlWebpackPlugin({
            filename: 'views/index.html',
            inject: false,
            template: 'src/app/views/index.html',
        }),
        new HtmlWebpackPlugin({
            filename: 'views/details.html',
            inject: false,
            template: 'src/app/views/details.html'
        }),
        new MiniCssExtractPlugin()
    ],
    optimization: {
        splitChunks: {
            cacheGroups: {
                styles: {
                    name: 'assets/css/styles',
                    type: 'css/mini-extract',
                    chunks: 'all',
                    enforce: true,
                },
            },
        },
    },
};