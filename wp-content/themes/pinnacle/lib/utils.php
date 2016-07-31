<?php

/**
 * Page titles
 */
function pinnacle_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'pinnacle');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      return $term->name;
    } elseif (is_post_type_archive()) {
      return get_queried_object()->labels->name;
    } elseif (is_day()) {
      return sprintf(__('Daily Archives: %s', 'pinnacle'), get_the_date());
    } elseif (is_month()) {
      return sprintf(__('Monthly Archives: %s', 'pinnacle'), get_the_date('F Y'));
    } elseif (is_year()) {
      return sprintf(__('Yearly Archives: %s', 'pinnacle'), get_the_date('Y'));
    } elseif (is_author()) {
      return sprintf(__('Author Archives: %s', 'pinnacle'), get_the_author());
    } else {
      return single_cat_title("", false);
    }
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'pinnacle'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'pinnacle');
  } else {
    return get_the_title();
  }
}

function kad_is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}
