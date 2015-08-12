+<?php
+/**
+* Plugin Name: Custom Car Reviews
+* Plugin URI: http://elegantthemes.com/
+* Description: A custom car review plugin built for example.
+* Version: 1.0
+* Author: Kunal Rathore, Phillip Le, Phil Ma
+* Author URI: http://justalever.com/
+**/
+
+/*
+	function to register the custom post types
+*/
+
+function register_cpt_car_review() {
+ 
+	// labels array for custom post types
+    $labels = array(
+        'name' => _x( 'car reviews', 'car_review' ),
+        'singular_name' => _x( 'car review', 'car_review' ),
+        'add_new' => _x( 'Add New', 'car_review' ),
+        'add_new_item' => _x( 'Add New Car Review', 'car_review' ),
+        'edit_item' => _x( 'Edit Car Review', 'car_review' ),
+        'new_item' => _x( 'New Car Review', 'car_review' ),
+        'view_item' => _x( 'View Car Review', 'car_review' ),
+        'search_items' => _x( 'Search Car Reviews', 'car_review' ),
+        'not_found' => _x( 'No car reviews found', 'car_review' ),
+        'not_found_in_trash' => _x( 'No Car reviews found in Trash', 'car_review' ),
+        'parent_item_colon' => _x( 'Parent Car Review:', 'car_review' ),
+        'menu_name' => _x( 'Car Reviews', 'car_review' ),
+    );
+ 
+	// arguments for custom post types
+    $args = array(
+        'labels' => $labels,
+        'hierarchical' => true,
+        'description' => 'Car reviews filterable by genre',
+        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
+        'taxonomies' => array( 'Types' ),
+        'public' => true,
+        'show_ui' => true,
+        'show_in_menu' => true,
+        'menu_position' => 5,
+        'menu_icon' => plugins_url( 'car.png', __FILE__ ),
+        'show_in_nav_menus' => true,
+        'publicly_queryable' => true,
+        'exclude_from_search' => false,
+        'has_archive' => true,
+        'query_var' => true,
+        'can_export' => true,
+        'rewrite' => true,
+        'capability_type' => 'post'
+    );
+	//register post types
+    register_post_type( 'car_review', $args );
+}
+ 
+add_action( 'init', 'register_cpt_car_review' );
+ 
+ // adding a custom taxonomy
+function types_taxonomy() {
+	//function to register taxonomy
+    register_taxonomy(
+        'types',
+        'car_review',
+		// taxonomy arguments
+        array(
+            'hierarchical' => true,
+            'label' => 'Types',
+            'query_var' => true,
+			'show_in_nav_menus' => true,
+            'rewrite' => array(
+                'slug' => 'genre',
+                'with_front' => false
+            )
+			
+        )
+    );
+}
+add_action( 'init', 'types_taxonomy');
+
+?>
