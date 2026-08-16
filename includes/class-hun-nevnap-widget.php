<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor widget magyar dátum, idő és névnap megjelenítéséhez.
 */
class Hun_Nevnap_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'hun_nevnap';
	}

	public function get_title(): string {
		return esc_html__( 'HunNévnap', 'hun-nevnap' );
	}

	public function get_icon(): string {
		return 'eicon-calendar';
	}

	public function get_categories(): array {
		return array( 'general' );
	}

	public function get_keywords(): array {
		return array( 'dátum', 'idő', 'óra', 'névnap', 'magyar' );
	}

	public function get_script_depends(): array {
		return array( 'hun-nevnap-widget' );
	}

	public function get_style_depends(): array {
		return array( 'hun-nevnap-widget' );
	}

	protected function register_controls(): void {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	private function register_content_controls(): void {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Tartalom', 'hun-nevnap' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'show_date',
			array(
				'label'        => esc_html__( 'Dátum megjelenítése', 'hun-nevnap' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'hun-nevnap' ),
				'label_off'    => esc_html__( 'Nem', 'hun-nevnap' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'show_time',
			array(
				'label'        => esc_html__( 'Pontos idő megjelenítése', 'hun-nevnap' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'hun-nevnap' ),
				'label_off'    => esc_html__( 'Nem', 'hun-nevnap' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'show_nameday',
			array(
				'label'        => esc_html__( 'Névnap megjelenítése', 'hun-nevnap' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Igen', 'hun-nevnap' ),
				'label_off'    => esc_html__( 'Nem', 'hun-nevnap' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'nameday_suffix',
			array(
				'label'     => esc_html__( 'Névnap utáni szöveg', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'névnap van', 'hun-nevnap' ),
				'condition' => array( 'show_nameday' => 'yes' ),
			)
		);

		$this->end_controls_section();
	}

	private function register_style_controls(): void {
		$this->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Megjelenés', 'hun-nevnap' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'layout',
			array(
				'label'     => esc_html__( 'Elrendezés', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'column' => array( 'title' => esc_html__( 'Függőleges', 'hun-nevnap' ), 'icon' => 'eicon-editor-list-ul' ),
					'row'    => array( 'title' => esc_html__( 'Vízszintes', 'hun-nevnap' ), 'icon' => 'eicon-ellipsis-h' ),
				),
				'default'   => 'column',
				'toggle'    => false,
				'selectors' => array( '{{WRAPPER}} .hun-nevnap-widget' => 'flex-direction: {{VALUE}};' ),
			)
		);

		$this->add_responsive_control(
			'items_spacing',
			array(
				'label'      => esc_html__( 'Elemek közötti térköz', 'hun-nevnap' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array( 'min' => 0, 'max' => 100 ),
					'em' => array( 'min' => 0, 'max' => 10, 'step' => 0.1 ),
				),
				'default'    => array( 'unit' => 'px', 'size' => 8 ),
				'selectors'  => array( '{{WRAPPER}} .hun-nevnap-widget' => 'gap: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Igazítás', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array( 'title' => esc_html__( 'Balra', 'hun-nevnap' ), 'icon' => 'eicon-text-align-left' ),
					'center'     => array( 'title' => esc_html__( 'Középre', 'hun-nevnap' ), 'icon' => 'eicon-text-align-center' ),
					'flex-end'   => array( 'title' => esc_html__( 'Jobbra', 'hun-nevnap' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'flex-start',
				'selectors' => array( '{{WRAPPER}} .hun-nevnap-widget' => 'align-items: {{VALUE}}; justify-content: {{VALUE}};' ),
			)
		);

		$this->add_control(
			'date_heading',
			array(
				'label'     => esc_html__( 'Dátum', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => esc_html__( 'Szín', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .hun-nevnap-date' => 'color: {{VALUE}};' ),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .hun-nevnap-date',
			)
		);

		$this->add_control(
			'time_heading',
			array(
				'label'     => esc_html__( 'Idő', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'time_color',
			array(
				'label'     => esc_html__( 'Szín', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .hun-nevnap-time' => 'color: {{VALUE}};' ),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'time_typography',
				'selector' => '{{WRAPPER}} .hun-nevnap-time',
			)
		);

		$this->add_control(
			'nameday_heading',
			array(
				'label'     => esc_html__( 'Névnap', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'nameday_color',
			array(
				'label'     => esc_html__( 'Névnap színe', 'hun-nevnap' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .hun-nevnap-names' => 'color: {{VALUE}};' ),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'nameday_typography',
				'selector' => '{{WRAPPER}} .hun-nevnap-names',
			)
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$now      = current_datetime();
		$names    = require HUN_NEVNAP_PATH . 'includes/nevnapok-hu.php';
		$key      = $now->format( 'm-d' );
		$nameday  = isset( $names[ $key ] ) && is_array( $names[ $key ] ) ? implode( ', ', $names[ $key ] ) : '';
		$show_date    = 'yes' === $settings['show_date'];
		$show_time    = 'yes' === $settings['show_time'];
		$show_nameday = 'yes' === $settings['show_nameday'] && '' !== $nameday;
		$date = $show_date ? wp_date( 'Y. F j.', $now->getTimestamp(), wp_timezone() ) : '';
		$time = $show_time ? wp_date( 'H:i:s', $now->getTimestamp(), wp_timezone() ) : '';
		?>
		<div class="hun-nevnap-widget">
			<?php if ( $show_date ) : ?>
				<span class="hun-nevnap-date"><?php echo esc_html( $date ); ?></span>
			<?php endif; ?>

			<?php if ( $show_time ) : ?>
				<time
					class="hun-nevnap-time"
					datetime="<?php echo esc_attr( $now->format( DATE_ATOM ) ); ?>"
					data-timezone="<?php echo esc_attr( wp_timezone()->getName() ); ?>"
					data-locale="<?php echo esc_attr( str_replace( '_', '-', get_locale() ) ); ?>"
				><?php echo esc_html( $time ); ?></time>
			<?php endif; ?>

			<?php if ( $show_nameday ) : ?>
				<div class="hun-nevnap-names">
					<?php echo esc_html( trim( $nameday . ' ' . $settings['nameday_suffix'] ) ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}
