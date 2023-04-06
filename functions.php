function SearchFilter($query) {
    if ($query->is_search) {
        $query->set( 'posts_per_page', 8 );
        $query->set('post_type', 'post');
        $s = $query->query_vars[ 's' ];
        $cat_id = get_cat_ID($s);

        // var_dump($s);
        // echo '===';
        // var_dump($cat_id);
        // echo '===';

        // echo '<pre>';
        // var_dump($query);
        // echo '</pre>';

        if ( $cat_id !== 0 ) {
            // echo 'category';
            $query->set('s', ''); // reset search query
            $term_posts = [];
            $posts = get_posts ("category=$cat_id");

            // var_dump($posts);
            foreach ($posts as $post) {
                // echo $post->ID;
                array_push($term_posts, $post->ID);
            }


            $query->set('post__in', $term_posts);
        } else {
            // echo 'not category';
        }
    }


    return $query;
} 
add_filter('pre_get_posts','SearchFilter');

