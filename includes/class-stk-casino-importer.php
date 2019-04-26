<?php

/**
 * Imports starter casinos into WP
 */
class Stk_Casino_Importer
{
    /**
     * Import casinos into WP
     *
     * @return void
     */
    public static function import()
    {
        $casinos = self::getCasinos();
        $default = [
            'post_data' => [
                'comment_status' => 'closed',
                'ping_status' => 'closed',
                'post_status' => 'publish',
                'post_type' => 'casino'
            ],
            'custom_fields' => [
                'bonus_percentage' => null,
                'bonus_maximum' => null,
                'free_spins' => null,
                'user_rating' => null,
                'our_rating' => null
            ]
        ];

        foreach ($casinos as $casino) {
            $casino = array_replace_recursive($default, $casino);
            $exists = get_posts([
                'name' => $casino['post_data']['post_name'],
                'post_type' => $casino['post_data']['post_type']
            ]);

            if (!$exists) {
                // Insert casino
                $casino_id = wp_insert_post($casino['post_data']);

                // Update custom fields
                if ($casino_id) {
                    foreach ($casino['custom_fields'] as $field => $val) {
                        if ($val) {
                            update_field($field, $val, $casino_id);
                        }
                    }
                }
            }
        }
    }

    /**
     * Get casinos
     *
     * @return array
     */
    public static function getCasinos()
    {
        return [
            [
                'post_data' => [
                    'post_title' => 'NorskeAutomater',
                    'post_name' => 'norske-automater',
                    'post_content' => '
						<ul>
							 <li>100 Freespins uten innskuddskrav</li>
							 <li>Det beste Norske casinoet</li>
							 <li>Stort spillutvalg og unike spill</li>
							 <li>Raske innskudd og uttak</li>
						</ul>'
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 2000,
                    'free_spins' => 100,
                    'user_rating' => 5,
                    'our_rating' => 5
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'InstaCasino',
                    'post_name' => 'instacasino',
                    'post_content' => '
                        <ul>
							 <li>30 RealSpins til Norske spillere</li>
							 <li>Kundeservice på norsk</li>
							 <li>Enkelt og brukervennlig</li>
							 <li>Hurtige innskudd og uttak</li>
						</ul>'
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 3000,
                    'free_spins' => 30,
                    'user_rating' => 1,
                    'our_rating' => 4
                ]
            ]
        ];
    }
}
