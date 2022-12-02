import { registerBlockVariation } from '@wordpress/blocks';

// Need for custom controls.
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const VARIATION_NAME = 'book-query-loop-variation';

registerBlockVariation('core/query', {
	name: VARIATION_NAME,
	title: 'Book List',
	description: 'Displays a list of books.',
	isActive: [ 'namespace' ],
	attributes: {
		namespace: VARIATION_NAME,
		query: {
			postType: 'book',
			perPage: 6,
			offset: 0,
			bookAuthor: ''
		},
	},
	allowedControls: [],
	innerBlocks: [
		[
			'core/post-template',
			{},
			[
				[ 'core/post-featured-image' ]
			],
		],
		[ 'core/query-pagination' ],
		[ 'core/query-no-results' ],
	]
} );

const isBookVariation = (props) => {
	const {
		attributes: { namespace },
	} = props;

	return namespace && namespace === VARIATION_NAME;
};

const AuthorInput = ( { props: {
	attributes,
	setAttributes
} } ) => {
	const { query } = attributes;

	return (
		<PanelBody title="Book">
			<TextControl
				label="Book Author"
				value={ query.bookAuthor }
				onChange={ ( value ) => {
					setAttributes( {
						query: {
							...query,
							bookAuthor: value
						}
					} );
				} }
			/>
		</PanelBody>
	);
};

export const withBookControls = ( BlockEdit ) => ( props ) => {

	return isBookVariation( props ) ? (
		<>
			<BlockEdit {...props} />
			<InspectorControls>
				<AuthorInput props={props} />
			</InspectorControls>
		</>
	) : (
		<BlockEdit {...props} />
	);
};

addFilter( 'editor.BlockEdit', 'core/query', withBookControls );
