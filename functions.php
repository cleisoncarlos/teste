  // CTP-------------------------------------------
  
  add_action('init', 'type_post_imoveis');
 
    function type_post_imoveis() { 
        $labels = array(
            'name' => _x('Imóveis', 'post type general name'),
            'singular_name' => _x('Imóvel', 'post type singular name'),
            'add_new' => _x('Adicionar Imóvel', 'Novo item'),
            'add_new_item' => __('Novo Imóvel'),
            'edit_item' => __('Editar Imóvel'),
            'new_item' => __('Novo Imóvel'),
            'view_item' => __('Ver Imóvel'),
            'search_items' => __('Procurar Imóvel'),
            'not_found' =>  __('Nenhum registro encontrado'),
            'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
            'parent_item_colon' => '',
            'menu_name' => 'Imóveis'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'public_queryable' => true,
            'show_ui' => true,           
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
			'menu_position' => 5,
			'menu_icon'           => 'dashicons-admin-home',
//'register_meta_box_cb' => 'imoveis_meta_box',       
            'supports' => array('title','editor','thumbnail','comments', 'excerpt', 'custom-fields')
          );
 
register_post_type( 'imoveis' , $args );
flush_rewrite_rules();
}

register_taxonomy(
	"tipo_imovel", 
		  "imoveis", 
		  array(            
			"label" => "Tipos de imóveis", 
				"singular_label" => "Tipo de Imóvel", 
				"rewrite" => true,
				"hierarchical" => true
	)
	
	);


	
register_taxonomy(
	"localizacao_imovel", 
		  "imoveis", 
		  array(            
			"label" => "Localizações dos imóveis", 
				"singular_label" => "Localização do Imóvel", 
				"rewrite" => true,
				"hierarchical" => true
	)
	
	);


	register_taxonomy(
		"finalidade_imovel", 
			  "imoveis", 
			  array(            
				"label" => "Finalidades dos imóveis", 
					"singular_label" => "Finalidade do imóvel", 
					"rewrite" => true,
					"hierarchical" => true
		)
		
		);
	
// METABOX -------------------------




function imoveis_meta_box( $meta_boxes ) {
	$prefix = 'moveis-';

	$meta_boxes[] = array(
		'id' => 'metabox_moveis',
		'title' => esc_html__( 'Cadastro de Móveis', 'metabox-online-generator' ),
		'post_types' => array('post' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'metabox_valor_imovel',
				
				'type' => 'text',
				'name' => esc_html__( 'Valor do Imóvel', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Coloque o valor em reais ( apenas números ex: 99.999,00)', 'metabox-online-generator' ),
				'std' => '00,00',
			),
			array(
				'id' => $prefix . 'metabox_finalidade_imovel',
				'name' => esc_html__( 'Finalidade do Imóvel', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Selecione um ítem', 'metabox-online-generator' ),
				'options' => array(
					'VENDA' => esc_html__( 'VENDA', 'metabox-online-generator' ),
					'ALUGUEL' => esc_html__( 'ALUGUEL', 'metabox-online-generator' ),
					'TEMPORADA' => esc_html__( 'TEMPORADA', 'metabox-online-generator' ),
				),
			),
			array(
				'id' => $prefix . 'metabox_area_privada',
				'type' => 'text',
				'name' => esc_html__( 'Área Privativa', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Coloque apenas numeros ( ex: 250) m²', 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'Área Privativa', 'metabox-online-generator' ),
			),
	
			array(
				'id' => $prefix . 'metabox_quantidade_quartos',
				'name' => esc_html__( 'Quantidade de Dormitório', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					1 => esc_html__( '1', 'metabox-online-generator' ),
					esc_html__( '2', 'metabox-online-generator' ),
					esc_html__( '3', 'metabox-online-generator' ),
					'4 ou mais' => esc_html__( '4', 'metabox-online-generator' ),
				),
			),
			array(
				'id' => $prefix . 'metabox_quantidade_vagas',
				'name' => esc_html__( 'Quantidade de Vagas de Garagem', 'metabox-online-generator' ),
				'type' => 'select',
				'desc' => esc_html__( 'descrição vagas', 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					1 => esc_html__( '1', 'metabox-online-generator' ),
					esc_html__( '2', 'metabox-online-generator' ),
					esc_html__( '3', 'metabox-online-generator' ),
					'4 ou mais' => esc_html__( '4', 'metabox-online-generator' ),
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'imoveis_meta_box' );

}
add_action( 'init', 'custom_post_type_imoveis', 0 );
