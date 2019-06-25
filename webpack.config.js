const path =require('path');
//const ExtractTextPlugin = require("extract-text-webpack-plugin");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
var LiveReloadPlugin = require('webpack-livereload-plugin');
const webpack =require('webpack');



let config = {
  entry: "./src/index.js",
  output: {
    path: path.resolve( "./dist"),
    filename: "main.js"
  },
  module: {
      rules: [
        {
          test: /\.scss$/,
          use: [
              MiniCssExtractPlugin.loader,
            //  "style-loader", // creates style nodes from JS strings
              "css-loader", // translates CSS into CommonJS
              "sass-loader", // translates CSS into CommonJS
          ]
        },
        {
          test: /\.css$/,
          use:[
              MiniCssExtractPlugin.loader,
              "css-loader",
          ]
        },
        {
          test: /\.(eot|svg|ttf|woff|woff2)$/,
           loader: 'file-loader?name=fonts/[name].[ext]'
        }
      ],


  },
  plugins: [
    new MiniCssExtractPlugin({
      filename:"[name].css"
    }),
    new LiveReloadPlugin(),

      new webpack.ProvidePlugin({
          'window.jQuery': 'jquery',
          'window.$': 'jquery',
          $: 'jquery'
      })
  ]
}

module.exports = config;
