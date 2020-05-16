<?php

if ( ! class_exists( 'Pro_Issues' ) ) {

	class Pro_Issues {

		function __construct() {

			add_action( 'init', array( $this, 'register_issues_taxonomies' ) );
			add_action( 'issues_add_form_fields', array( $this, 'add_form_fields' ) );
			add_action( 'issues_edit_form_fields', array( $this, 'issues_edit_image_field' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'issues_scripts' ) );
			add_action( 'admin_head', function () {
				wp_enqueue_media();
			} );

			add_action( 'created_issues', array( $this, 'save_issues_data' ) );
			add_action( 'edited_issues', array( $this, 'save_issues_data' ) );

			add_filter( 'manage_edit-issues_columns', array( $this, 'register_issues_columns' ) );
			add_filter( 'manage_issues_custom_column', array( $this, 'issues_column_display' ), 10, 3 );
		}

		function register_issues_taxonomies() {

			register_taxonomy(
				'issues',
				'post',
				array(
					'hierarchical'      => true,
					'label'             => esc_html__( 'Issues', 'themeplate' ),
					'query_var'         => true,
					'show_admin_column' => true,
					'rewrite'           => array(
						'slug'       => 'issues',
						'with_front' => true
					)
				)
			);
		}

		function save_issues_data( $tax_id ) {

			if ( isset( $_REQUEST['category-image-id'] ) ) {
				update_term_meta( $tax_id, 'image_id', ! empty( $_REQUEST['category-image-id'] ) ? intval( $_REQUEST['category-image-id'] ) : '' );
			}
			if ( isset( $_REQUEST['publication'] ) ) {
				update_term_meta( $tax_id, 'publication', ! empty( $_REQUEST['publication'] ) ? sanitize_text_field( $_REQUEST['publication'] ) : '' );
			}
			if ( isset( $_REQUEST['price'] ) ) {
				update_term_meta( $tax_id, 'price', ! empty( $_REQUEST['price'] ) ? $_REQUEST['price'] : 5.95 );
			}
			if ( isset( $_REQUEST['ecommerce_enabled'] ) ) {
				update_term_meta( $tax_id, 'ecommerce_enabled', isset( $_REQUEST['ecommerce_enabled'] ) ? 'yes' : 'no' );
			}

			if ( isset( $_REQUEST['publication_date']['month'] ) && isset ( $_REQUEST['publication_date']['year'] ) ) {

			$month            = ! empty( $_REQUEST['publication_date']['month'] ) ? sanitize_text_field( $_REQUEST['publication_date']['month'] ) : '';
			$year             = ! empty( $_REQUEST['publication_date']['year'] ) ? intval( $_REQUEST['publication_date']['year'] ) : '';
			$publication_date = strtotime( $month . $year );
				update_term_meta( $tax_id, 'publication_date', $publication_date );
			}
		}

		function add_form_fields() { ?>

			<div class="form-field term-group">
				<label for='category-image-id'><?php _e( 'Image' ); ?></label>
				<input type="hidden" name="category-image-id" id="category-image-id" value="">
				<img src="" class="uploaded-image" style="max-height: 240px; max-width: 320px;">

				<p style="margin: 15px 5px;">
					<button id="issues-upload" class="button button-secondary">Upload</button>
					<button id="issues-remove" class="button button-secondary">Remove</button>
				</p>

			</div>

			<div class="form-field term-group">
				<label for='publication'><?php _e( 'Publication' ); ?></label>
				<select name="publication" id="publication">
					<?php
					$publications = array(
						'Washington Parent Amplified',
						'Washington Parent Home Magazine',
						'Washington Parent Monthly',
						'Best Bet',
						'Bridal Bash Blog',
						'Dimensions',
						'People of ATX',
						'r5ahm',
						'r5am',
						'Tasty Tidbits',
					);

					foreach ( $publications as $publication ) {
						printf( '<option value="%1$s">%1$s</option>', $publication );
					}

					?>
				</select>
			</div>

			<div class="form-field term-group">
				<label for='publication_month'><?php _e( 'Publication Date' ); ?></label>
				<select name="publication_date[month]" id="publication_month">
					<?php
					$months = array(
						'January',
						'February',
						'March',
						'April',
						'May',
						'June',
						'July ',
						'August',
						'September',
						'October',
						'November',
						'December',
					);

					foreach ( $months as $month ) {
						printf( '<option value="%1$s">%1$s</option>', $month );
					}

					?>
				</select>

				<select name="publication_date[year]" id="publication_year">
					<?php
					$current_year = date( 'Y' );
					$years        = range( $current_year, $current_year - 10 );
					rsort( $years );

					foreach ( $years as $year ) {
						printf( '<option value="%1$s">%1$s</option>', $year );
					}

					?>
				</select>
			</div>

			<div class="form-field term-group">
				<label for='ecommerce_enabled'><?php _e( 'Ecommerce Enabled' ); ?></label>
				<input type="checkbox" name="ecommerce_enabled" id="ecommerce_enabled" value="yes">
				<p>Check to enable ecommerce functionality.</p>
			</div>

			<div class="form-field term-group" id="price-field" style="display: none;">
				<label for='price'><?php _e( 'Price' ); ?></label>
				<input type="text" name="price" id="price" placeholder="5.95">
			</div>

		<?php }

		function issues_edit_image_field( $taxonomy ) {

			$image_id         = get_term_meta( $taxonomy->term_id, 'image_id', true );
			$image            = wp_get_attachment_image_url( $image_id, 'thumbnail' );
			$image            = ! empty( $image ) ? $image : get_template_directory_uri() . '/assets/images/issues_image.jpg';
			$publication      = get_term_meta( $taxonomy->term_id, 'publication', true );
			$price            = get_term_meta( $taxonomy->term_id, 'price', true );
			$enabled          = get_term_meta( $taxonomy->term_id, 'ecommerce_enabled', true );

			$publication_date = get_term_meta( $taxonomy->term_id, 'publication_date', true );
			$publication_year = '';
			$publication_month = '';
			if ( ! empty( $publication_date ) ) {
				$publication_year = date('Y', $publication_date);
				$publication_month = date('F', $publication_date);
			}

			?>


			<tr class='form-field'>
				<th scope='row'><label for='category-image-id'><?php _e( 'Image' ); ?></label></th>
				<input type="hidden" name="category-image-id" id="category-image-id" value="<?php echo $image_id; ?>">
				<td>
					<img src="<?php echo $image ?>" class="uploaded-image" style="max-height: 240px; max-width: 320px;">
					<p style="margin: 15px 5px;">
						<button id="issues-upload" class="button button-secondary">Upload</button>
						<button id="issues-remove" class="button button-secondary">Remove</button>
					</p>

				</td>
			</tr>

			<tr class='form-field'>
				<th scope='row'><label for='publication'><?php _e( 'Publication' ); ?></label></th>
				<td>
					<select name="publication" id="publication">
						<?php
						$publications = array(
							'Washington Parent Amplified',
							'Washington Parent Home Magazine',
							'Washington Parent Monthly',
							'Best Bet',
							'Bridal Bash Blog',
							'Dimensions',
							'People of ATX',
							'r5ahm',
							'r5am',
							'Tasty Tidbits',
						);

						foreach ( $publications as $pub ) {
							printf( '<option value="%1$s" %2$s>%1$s</option>', $pub, selected( $publication, $pub, false ) );
						}

						?>
					</select>
				</td>
			</tr>

			<tr class='form-field'>
				<th scope='row'><label for='publication_month'><?php _e( 'Publication Date' ); ?></label></th>
				<td>
					<select name="publication_date[month]" id="publication_month">
						<?php

						$months = array(
							'January',
							'February',
							'March',
							'April',
							'May',
							'June',
							'July ',
							'August',
							'September',
							'October',
							'November',
							'December',
						);

						foreach ( $months as $month ) {
							printf( '<option value="%1$s" %2$s>%1$s</option>', $month, selected( $month, $publication_month, false ) );
						}

						?>
					</select>

					<select name="publication_date[year]" id="publication_year">
						<?php
						$current_year = date( 'Y' );
						$years        = range( $current_year, $current_year - 10 );
						rsort( $years );

						foreach ( $years as $year ) {
							printf( '<option value="%1$s" %2$s>%1$s</option>', $year, selected( $year, $publication_year, false ) );
						}

						?>
					</select>
				</td>
			</tr>

			<tr class='form-field'>
				<th><label for='ecommerce_enabled'><?php _e( 'Ecommerce Enabled' ); ?></label></th>
				<td>
					<input type="checkbox" name="ecommerce_enabled" id="ecommerce_enabled" <?php checked( $enabled, 'yes' ); ?> value="<?php echo $enabled; ?>">
				</td>
			</tr>

			<tr class='form-field' id="price-field" <?php if ( 'yes' != $enabled ){ ?>style="display: none;" <?php } ?>>
				<th><label for='price'><?php _e( 'Price' ); ?></label></th>
				<td><input type="text" name="price" id="price" placeholder="5.95" value="<?php echo $price; ?>"></td>
			</tr>

		<?php }

		function register_issues_columns( $columns ) {
			$columns['publication'] = __( 'Publication', 'themeplate' );
			$columns['ecommerce']   = __( 'Ecommerce', 'themeplate' );
			$columns['price']       = __( 'Price', 'themeplate' );
			$columns['thumb']       = __( 'Image', 'themeplate' );

			return $columns;
		}

		function issues_column_display( $string = '', $column_name, $term_id ) {

			if ( empty( $term_id ) ) {
				return;
			}

			if ( $column_name == 'thumb' ) {
				$image_id = get_term_meta( $term_id, 'image_id', true );
				$image    = wp_get_attachment_image_url( $image_id, 'thumbnail' );
				$image    = ! empty( $image ) ? $image : 'https://via.placeholder.com/45x45?text=No Image';
				printf( '<img class="category-image-render" src="%s" width="44px" height="44px">', esc_url( $image ) );
			}

			if ( $column_name == 'price' ) {
				$price = get_term_meta( $term_id, 'price', true );
				echo $price;
			}

			if ( $column_name == 'ecommerce' ) {
				$enabled = get_term_meta( $term_id, 'ecommerce_enabled', true );
				echo 'yes' == $enabled ? '✔️' : '';
			}

			if ( $column_name == 'publication' ) {
				$publication = get_term_meta( $term_id, 'publication', true );
				echo $publication;
			}

		}

		function issues_scripts() {

			?>
			<script>

				jQuery('#issues-upload').click(function (e) {
					e.preventDefault();
					var image = wp.media({
						title: 'Upload Image',
						multiple: false
					}).open()
						.on('select', function (e) {
							var uploaded_image = image.state().get('selection').first();
							var image_url = uploaded_image.toJSON().url;
							var image_id = uploaded_image.toJSON().id;
							jQuery('.uploaded-image').attr('src', image_url);
							jQuery('#category-image-id').val(image_id);
						});
				});


				jQuery('#issues-remove').click(function (e) {
					e.preventDefault();
					jQuery('.uploaded-image').attr('src', '');
					jQuery('#category-image-id').val('');
				});


				jQuery('#ecommerce_enabled').click(function (e) {
					var price = jQuery('#price-field');
					if (this.checked) {
						price.show();
					} else {
						price.hide();
					}
				});


			</script>
		<?php }

	}

	new Pro_Issues();
}

