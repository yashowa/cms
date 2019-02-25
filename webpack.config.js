const path =require('path');
//const ExtractTextPlugin = require("extract-text-webpack-plugin");
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

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
        }
      ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename:"[name].css"
    })
  ]
}

module.exports = config;
