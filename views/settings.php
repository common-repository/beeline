<?php $settings = $this->getSettings(); ?>

<div class="wrap">
	<h2><?php _e( 'Beeline Settings' ); ?></h2>
	<form method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th colspan='3'>Enter your blog's ID (or <a href='http://beeline.xnosis.com/reg/publisher-registration.html'>get one</a>) to connect your widget to the Beeline dashboard</th>
				</tr>
				<tr>
					<th scope="row"><label for="beeline_publisher_id"><?php _e( "Beeline ID" ); ?></label></th>
					<td>
						<input type="text" class="regular-text" id="beeline_publisher_id" name="beeline_publisher_id" value="<?php echo attribute_escape( $settings[ 'beeline_publisher_id' ] ); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="beeline_included_cats"><?php _e( "Included Categories" ); ?></label></th>
					<td>
						<input type="text" class="regular-text" id="beeline_included_cats" name="beeline_included_cats" value="<?php echo attribute_escape( $settings[ 'beeline_included_cats' ] ); ?>" />
                        <p><small>
                        An <strong>optional</strong> comma-separated list of blog categories (e.g. News,Great Poetry,Fun)<br>
                        Limits Beeline to posts belonging to <strong>one or more</strong> of the given categories, or left blank to index all posts
                        </small></p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<?php wp_nonce_field( 'save-xnosis-beeline-for-wordpress-settings' ); ?>
			<input type="submit" name="save-xnosis-beeline-for-wordpress-settings" id="save-xnosis-beeline-for-wordpress-settings" value="<?php _e( 'Save Settings' ); ?>" />
		</p>
		<p><strong>Please allow for a couple of hours before Beeline is activated on your blog. If you do not see our bees within 24 hours please contact our support.</strong></p>
		<hr>
		<p>Want to <a href="<?php echo 'http://tomcat.xnosis.com/xnosis/beeline/publishers/' . attribute_escape( $settings[ 'beeline_publisher_id' ] ) . '/publisher-rereg.html'?>">change</a> your logo, or email address? (you must have already saved your ID to do that)</p>
		<p>Don't have a publisher ID yet? <a href='http://beeline.xnosis.com/reg/publisher-registration.html'>Get one now</a></p>		
	</form>
</div>