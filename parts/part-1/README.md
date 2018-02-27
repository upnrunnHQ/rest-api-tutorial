We have a basic plugin ready where we can write code. Before writing any code, let's think that your post has a special meta key where you store the total number of post views. We need to add a new post views field to WP REST API response. There has two methods to add new field to the WP REST API response.

First, I will show you how you can register a new field to WordPress API response using register_rest_field and get or update post views. We will register the field at rest_api_init action.

Create a new file called "method-1.php" and to include it in class-rest-api-tutorial.php update the "includes" method with the following code.

```php
// Includes
public function includes() {
    include_once REST_API_TUTORIAL_PLUGIN_DIR . '/parts/part-1/method-1.php';
}
```

Inside the "method-1.php" add the following code to register the "post_views" field.

```php
add_action( 'rest_api_init', 'register_post_fields' );

// Register post fields.
function register_post_fields() {
    register_rest_field( 'post', 'post_views', array(
        'get_callback'    => 'get_post_views,
        'update_callback' => 'update_post_views',
        'schema' => array(
            'description' => __( 'Post views.' ),
            'type'        => 'integer'
        ),
    ));
}
```

We did not add the callback functions yet. Let's add the callback functions.

```php
// Get post views
function get_post_views( $post_obj ) {
    $post_id = $post_obj['id'];
    return get_post_meta($post_id, 'post_views', true);
}

// Update post views
function update_post_views( $value, $post, $key ) {

    $post_id = update_post_meta( $post->ID, $key, $value );

    if ( false === $post_id ) {
        return new WP_Error(
          'rest_post_views_failed',
          __( 'Failed to update post views.' ),
          array( 'status' => 500 )
        );
    }

    return true;
}
```

You also can use register_meta function to simply define the meta field for a particular post type.

Create another new file called "method-2.php" and to include it in class-rest-api-tutorial.php update the "includes" method with the following code.

```php
// Includes
public function includes() {
    include_once REST_API_TUTORIAL_PLUGIN_DIR . '/parts/part-1/method-1.php';
    include_once REST_API_TUTORIAL_PLUGIN_DIR . '/parts/part-1/method-2.php';
}
```

Inside the "method-2.php" add the following code to register the post meta.

```php
// Register post meta
public function register_post_meta() {
    $object_type = 'post';
    $args = array(
        'type'     	   => 'string',
        'description'  => 'A meta key associated with post views.',
        'single'   	   => true,
        'show_in_rest' => true,
    );

    register_meta( $object_type, 'post_views', $args );
}
```

Now, we can easily  get or update the post meta by sending GET or POST request to wp-json/wp/v2/posts/<post-id>

In the next tutorial, I will show you how extend WP REST API by adding custom endpoints.

