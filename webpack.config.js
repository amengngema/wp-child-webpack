const path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin")
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')


module.exports = {
	entry: './src/js/index.js',
	output: {
		filename:'bundle.js',
		path:path.resolve(__dirname,'dist/js')
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader'
				}
			},
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader',
                ]
            },
            {
                test: /\.css$/,
                loader: 'style-loader'
            },
            {
                test: /\.css$/,
                loader: 'css-loader',
                options: {
                    minimize: true
                }
            }
		]
	},
    plugins: [
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: '../css/bundle.css',
            //chunkFilename: devMode ? '../[id].css' : '[id].[hash].css',
        })
    ]
}