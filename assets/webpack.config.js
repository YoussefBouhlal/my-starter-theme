const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	...{
		entry: {
			'js/editor': path.resolve( process.cwd(), 'src/js', 'editor.js' ),
			'js/main': path.resolve( process.cwd(), 'src/js', 'main.js' ),
			'css/editor': path.resolve( process.cwd(), 'src/scss', 'editor.scss' ),
			'css/main': path.resolve( process.cwd(), 'src/scss', 'main.scss' ),
			'css/editor-layout': path.resolve( process.cwd(), 'src/scss', 'editor-layout.scss' )
		},
		plugins: [
			...defaultConfig.plugins,
			new RemoveEmptyScriptsPlugin( {
				stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
			} )
		]
	}
};