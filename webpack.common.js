/*
 * NovaeZEnhancedImageAssetBundle.
 *
 * @package   NovaeZEnhancedImageAssetBundle
 *
 * @author    Novactive <f.alexandre@novactive.com>
 * @copyright 2018 Novactive
 * @license   https://github.com/Novactive/NovaeZEnhancedImageAssetBundle/blob/master/LICENSE
 *
 */

const path = require('path');

module.exports = {
    entry: {
        focuspoint: './src/js/focuspoint.js',
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'src/bundle/Resources/public/js')
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader',
            }
        ],
    },
};