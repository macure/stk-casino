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
                'post_type' => 'casino',
                'menu_order' => 0,
            ],
            'attachments' => [
                'feature_image' => [
                    'url' => null,
                    'attachment_data' => [
                        'title' => null,
                        'caption' => null,
                        'alt_text' => null,
                        'description' => null
                    ]
                ]
            ],
            'custom_fields' => [
                'bonus_percentage' => null,
                'bonus_maximum' => null,
                'spins' => [
                    'spin_type' => null,
                    'spin_number' => null
                ],
                'user_rating' => null,
                'our_rating' => null,
                'affiliate_link' => null
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

                if ($casino_id) {
                    // Update custom fields
                    foreach ($casino['custom_fields'] as $field => $val) {
                        if ($val) {
                            update_field($field, $val, $casino_id);
                        }
                    }

                    // Download feature image
                    $download_remote_image = new Stk_Casino_Download_Remote_Image($casino['attachments']['feature_image']['url'], $casino['attachments']['feature_image'][ 'attachment_data']);
                    $attachment_id = $download_remote_image->download();

                    if ($attachment_id) {
                        // Assign feature image to casino
                        set_post_thumbnail($casino_id, $attachment_id);
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
                        </ul>',
                    'menu_order' => 1
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/norskeautomater-logo.png'
                        ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 2000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 100
                    ],
                    'user_rating' => 5,
                    'our_rating' => 5,
                    'affiliate_link' => 'http://www.norskeaffiliates.com/redirector?url=http://www.norskeautomater.com&userid=10&tracker=9842'
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
                        </ul>',
                    'menu_order' => 2
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/instacasino857-497x334.png'
                        ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 3000,
                    'spins' => [
                        'spin_type' => 'real',
                        'spin_number' => 30
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.honestpartners.com/redirect.aspx?pid=10923&bid=1552'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Comeon',
                    'post_name' => 'comeon',
                    'post_content' => '<ul>
							 <li>Ingen freespins, men flere bonuser</li>
							 <li>50 KR på Jackpot 6000 ved innskudd</li>
							 <li>Gratis chillelongs ved innskudd</li>
							 <li>Mange kampanjer og bonuser</li>
                        </ul>',
                    'menu_order' => 18
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/Comeon-logo-300x202.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 5000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 0
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.comeon.com/tracking.php?tracking_code&aid=110575&mid=1784&sid=384493&pid=490'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Norgesspill',
                    'post_name' => 'norgesspill',
                    'post_content' => '<ul>
							 <li>Du har valg mellom to innskuddsbonuser</li>
							 <li>100% opptil 2 500 KR, eller</li>
							 <li>Sett inn 100 KR, Spill med 600 KR</li>
							 <li>Mange spennende kampanjer</li>
                        </ul>',
                    'menu_order' => 19
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/NorgesSpill_497x334.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 2500,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 0
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://ads.norgesspill.com/tracking.php?tracking_code&aid=110575&mid=906&sid=384493&pid=95'
                ]
            ],[
                'post_data' => [
                    'post_title' => 'Folkeautomaten',
                    'post_name' => 'folkeautomaten',
                    'post_content' => '<ul>
							 <li>20 Freespins uten innskuddskrav</li>
							 <li>Sett inn 100 KR, Spill med 600 KR</li>
							 <li>Flere spennende kampanjer</li>
							 <li>Tjen poeng på dine aktiviteter</li>
                        </ul>',
                    'menu_order' => 20
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/folkeautomaten.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 500,
                    'bonus_maximum' => 600,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 20
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.folkeautomaten.com/tracking.php?tracking_code&aid=110575&mid=1736&sid=384493&pid=442'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'BOBCasino',
                    'post_name' => 'bobcasino',
                    'post_content' => '<ul>
							 <li>10 Freespins uten innskuddskrav</li>
							 <li>25x4 Freespins ved første innskudd</li>
							 <li>Bonus på flere innskudd</li>
							 <li>Mange kampanjer</li>
                        </ul>',
                    'menu_order' => 12
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/bobcasino-logo5.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 110
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.playamopartners.com/redirect.aspx?pid=3897&bid=1915&lpid=8'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Chanz',
                    'post_name' => 'chanz',
                    'post_content' => '<ul>
							 <li>10 Freespins uten innskudd</li>
							 <li>300 Freespins delt på 4 innskudd</li>
							 <li>Husk å bruke bonuskode</li>
							 <li>Raske på uttak</li>
                        </ul>',
                    'menu_order' => 8
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/chanz-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 50
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://wlchanz.adsrv.eacdn.com/C.ashx?btag=a_2811b_91c_&affid=753&siteid=2811&adid=91&c='
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Temple Nile',
                    'post_name' => 'temple-nile',
                    'post_content' => '<ul>
							 <li>30 Freespins på første innskudd</li>
							 <li>Stor matchbonus</li>
							 <li>Spennende casinokonsept</li>
							 <li>Stort spillutvalg</li>
                        </ul>',
                    'menu_order' => 7
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/temple-nile-transparent-494x334.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 200,
                    'bonus_maximum' => 5000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 30
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://wlivyaffiliates.adsrv.eacdn.com/C.ashx?btag=a_10462b_249c_&affid=2220&siteid=10462&adid=249&c='
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Spinia',
                    'post_name' => 'spinia',
                    'post_content' => '<ul>
							 <li>25 Freespins ved første innskudd</li>
							 <li>Bonus på andre innskudd</li>
							 <li>Daglige turneringer</li>
							 <li>Ukentlige bonuskampanjer</li>
                        </ul>',
                    'menu_order' => 14
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/Spinia-logo-01-497x334.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 25
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.playamopartners.com/redirect.aspx?pid=3897&bid=1931&lpid=45'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Genesis Casino',
                    'post_name' => 'genesis-casino',
                    'post_content' => '<ul>
							 <li>Opptil 10 000 KR total bonus</li>
							 <li>Store progressive jackpotter</li>
							 <li>Spill fra flere leverandører</li>
							 <li>Mange spennende kampanjer</li>
                        </ul>',
                    'menu_order' => 3
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/genesis-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 300
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://GenesisCasino.tracking-genesisaffiliates.com/redirect.aspx?pid=155630&bid=4375'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Wishmaker',
                    'post_name' => 'wishmaker',
                    'post_content' => '<ul>
							 <li>20x5 Freespins ved første innskudd</li>
							 <li>Opptil 7000 KR i bonus</li>
							 <li>Bonusen er fordelt på to innskudd</li>
							 <li>Artig lojalitetsprogram</li>
                        </ul>',
                    'menu_order' => 15
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/wishmaker-casino-logo2.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 7000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 100
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.wishmaker.partners/redirect.aspx?pid=3227&lpid=19&bid=1488'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Betchan',
                    'post_name' => 'betchan',
                    'post_content' => '<ul>
							 <li>30 Freespins på første innskudd</li>
							 <li>Bonus på de fire første innskuddene</li>
							 <li>Ukentlige turneringer</li>
							 <li>Ukentlige kampanjer</li>
                        </ul>',
                    'menu_order' => 13
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/BetChan-Casino-Logo4.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 30
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.playamopartners.com/redirect.aspx?pid=3897&bid=1927&lpid=9'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Playamo',
                    'post_name' => 'playamo',
                    'post_content' => '<ul>
							 <li>20x5 Freespins ved første innskudd</li>
							 <li>Opptil 1000kr i matchbonus</li>
							 <li>Flere kampanjer hver uke</li>
							 <li>Stort spillutvalg</li>
                        </ul>',
                    'menu_order' => 11
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/playamo-casino.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 1000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 100
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.playamopartners.com/redirect.aspx?pid=3897&bid=1522&lpid=6'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Mrplay',
                    'post_name' => 'mrplay',
                    'post_content' => '<ul>
							 <li>100 Freespins ved første innskudd</li>
							 <li>Gis ut 20+40+40 over tre dager</li>
							 <li>Tjen bonuspoeng når du spiller</li>
							 <li>Mange ukentlige kampanjer</li>
                        </ul>',
                    'menu_order' => 16
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/mrplay-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 2000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 100
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://online.mrplaypartners.com/promoRedirect?key=ej0xMzUzMDg4MiZsPTEzNTI1MzA0JnA9ODM1NQ%3D%3D'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'VegasCasino',
                    'post_name' => 'vegas-casino',
                    'post_content' => '<ul>
							 <li>20 Freespins uten innskuddskrav</li>
							 <li>Stor matchbonus på 200%</li>
							 <li>Unike spilleautomater og casinospill</li>
							 <li>Mange spennende kampanjer</li>
                        </ul>',
                    'menu_order' => 9
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/Vegas-casino-logo2.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 200,
                    'bonus_maximum' => 2000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 20
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://vegas.riveraffiliates.com/tracking.php?tracking_code&aid=100374&mid=1422&sid=338103&pid=260'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Coolbet',
                    'post_name' => 'coolbet',
                    'post_content' => '<ul>
							 <li>50 Freespins på Super Flip</li>
							 <li>Meget bra velkomstbonus</li>
							 <li>Unikt og moderne casino</li>
							 <li>Drevet av bransjeveteraner</li>
                        </ul>',
                    'menu_order' => 6
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/coolbet.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 200,
                    'bonus_maximum' => 2000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 50
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://track.adform.net/C/?bn=28886309'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Frank&Fred',
                    'post_name' => 'frankandfred-casino',
                    'post_content' => '<ul>
							 <li>200 Freespins på første innskudd</li>
							 <li>Veldig stor velkomstbonus</li>
							 <li>En litt anderledes spillopplevelse</li>
							 <li>Tilbyr også mange lotterier</li>
                        </ul>',
                    'menu_order' => 4
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/frankandfred-casino-logo2.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 200,
                    'bonus_maximum' => 10000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 200
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://frankfred.epic.partners/tracking.php?tracking_code&aid=100376&mid=868&sid=2752&pid=2'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'GetLucky',
                    'post_name' => 'getlucky',
                    'post_content' => '<ul>
							 <li>Sett inn 100 KR - Spill med 600 KR</li>
							 <li>25x4 Freespins ved første innskudd</li>
							 <li>Bra spillutvalg</li>
							 <li>Tjen poeng når du spiller</li>
                        </ul>',
                    'menu_order' => 10
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/getlucky-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 600,
                    'bonus_maximum' => 500,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 100
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'https://media.getlucky.com/tracking.php?tracking_code&aid=110575&mid=2005&sid=384493&pid=643'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => '21.com',
                    'post_name' => '21-com',
                    'post_content' => '<ul>
							 <li>210 Gratisspinns uten innskuddskrav</li>
							 <li>Opptil 2100kr i total bonus</li>
							 <li>Enkelt å komme i gang</li>
							 <li>God totalpakke</li>
                        </ul>',
                    'menu_order' => 5
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/21-com-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 500,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 210
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://wl21com.adsrv.eacdn.com/C.ashx?btag=a_2236b_235c_&affid=641&siteid=2236&adid=235&c='
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'Betsafe',
                    'post_name' => 'betsafe',
                    'post_content' => '<ul>
							 <li>10 BigSpins på Gonzos Quest</li>
							 <li>Bonus på de tre første innskuddene</li>
							 <li>Daglige turneringer</li>
							 <li>Bra spillutvalg</li>
                        </ul>',
                    'menu_order' => 17
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/betsafe-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 100,
                    'bonus_maximum' => 2500,
                    'spins' => [
                        'spin_type' => 'big',
                        'spin_number' => 10
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://record.betsafe.com/_MZFmhmtOC4SV0EOOSRKudCPK8EQLgMPe/1/&media=184380&campaign=1'
                ]
            ],
            [
                'post_data' => [
                    'post_title' => 'DreamVegas',
                    'post_name' => 'dreamvegas',
                    'post_content' => '<ul>
							 <li>50 Freespins på første innskudd</li>
							 <li>Opptil 25 000kr i første innskuddsbonus</li>
							 <li>Sett inn 5 000, spill med 15 000 etc.</li>
							 <li>Tjen poeng og vinn en bil!</li>
                        </ul>',
                    'menu_order' => 21
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/03/betsafe-casino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 200,
                    'bonus_maximum' => 25000,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 50
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://wlivyaffiliates.adsrv.eacdn.com/C.ashx?btag=a_11254b_228c_&affid=2421&siteid=11254&adid=228&c='
                ]
                ],[
                'post_data' => [
                    'post_title' => 'Fun Casino',
                    'post_name' => 'fun-casino',
                    'post_content' => '<ul>
							 <li>11 Freespins uten innskuddskrav</li>
							 <li>100 Freespins på første innskudd</li>
							 <li>Bonus på dine 2 første innskudd</li>
							 <li>Byr på god casinounderholdning</li>
                        </ul>',
                    'menu_order' => 22
                ],
                'attachments' => [
                    'feature_image' => [
                        'url' => 'https://www.norgescasino.com/wp-content/uploads/2019/04/funcasino-logo.png'
                    ]
                ],
                'custom_fields' => [
                    'bonus_percentage' => 50,
                    'bonus_maximum' => 4990,
                    'spins' => [
                        'spin_type' => 'free',
                        'spin_number' => 111
                    ],
                    'user_rating' => 4,
                    'our_rating' => 4,
                    'affiliate_link' => 'http://www.funcasinoaffiliates.com/redirector?url=http://www.funcasino.com&userid=776&tracker=35335'
                ]
            ]
        ];
    }
}
