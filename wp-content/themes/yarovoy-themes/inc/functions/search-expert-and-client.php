<?php
add_filter('acf/fields/user/query', 'acf_user_search_no_duplicates', 20, 3);
function acf_user_search_no_duplicates($args, $field, $post_id)
{
    if (!in_array($field['key'], ['field_67339254a2e6b', 'field_67339285a2e6c'])) {
        return $args;
    }

    $search = isset($_POST['s']) ? $_POST['s'] : (isset($args['search']) ? $args['search'] : '');

    if (empty($search)) {
        return $args;
    }

    unset($args['search']);

    $search_term = str_replace('*', '', $search);

    $user_query = new WP_User_Query(array(
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'user_email',
                'value'   => $search_term,
                'compare' => 'LIKE'
            )
        ),
        'fields' => 'ID'
    ));

    $user_ids = $user_query->get_results();

    if (!empty($user_ids)) {
        $args['include'] = $user_ids;
    } else {
        $args['include'] = array(0);
    }

    return $args;
}

add_filter('acf/fields/user/result', 'format_user_display_name', 10, 4);
function format_user_display_name($text, $user, $field, $post_id)
{
    $first_name = get_user_meta($user->ID, 'first_name', true);
    $last_name = get_user_meta($user->ID, 'last_name', true);

    $full_name = trim($first_name . ' ' . $last_name);
    if (!empty($full_name)) {
        return $user->user_email . ' (' . $full_name . ')';
    }

    return $text;
}
