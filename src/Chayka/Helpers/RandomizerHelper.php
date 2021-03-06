<?php
/**
 * Created by PhpStorm.
 * User: borismossounov
 * Date: 24.03.16
 * Time: 17:49
 */

namespace Chayka\Helpers;

/**
 * Class RandomizerHelper is a little helper that allowes to generate random name
 * like 'Adventurous Shakespeare'
 * @package Chayka\Helpers
 */
class RandomizerHelper{

    /**
     * Positive adjectives to describe our random characters
     *
     * @var array
     */
    protected static $adjectives = [
        'adaptable',
        'adventurous',
        'affable',
        'affectionate',
        'agreeable',
        'ambitious',
        'amiable',
        'amicable',
        'amusing',
        'brave',
        'bright',
        'calm',
        'careful',
        'charming',
        'communicative',
        'compassionate',
        'conscientious',
        'considerate',
        'convivial',
        'courageous',
        'courteous',
        'creative',
        'decisive',
        'determined',
        'diligent',
        'diplomatic',
        'discreet',
        'dynamic',
        'easygoing',
        'emotional',
        'energetic',
        'enthusiastic',
        'exuberant',
        'faithful',
        'fearless',
        'forceful',
        'frank',
        'friendly',
        'funny',
        'generous',
        'gentle',
        'good',
        'gregarious',
        'helpful',
        'honest',
        'humorous',
        'imaginative',
        'impartial',
        'independent',
        'intellectual',
        'intelligent',
        'intuitive',
        'inventive',
        'kind',
        'loving',
        'loyal',
        'modest',
        'neat',
        'nice',
        'optimistic',
        'passionate',
        'patient',
        'persistent',
        'pioneering',
        'philosophical',
        'placid',
        'plucky',
        'polite',
        'powerful',
        'practical',
        'quiet',
        'rational',
        'reliable',
        'reserved',
        'resourceful',
        'romantic',
        'sensible',
        'sensitive',
        'shy',
        'sincere',
        'sociable',
        'straightforward',
        'sympathetic',
        'thoughtful',
        'tidy',
        'tough',
        'unassuming',
        'understanding',
        'versatile',
        'warmhearted',
        'willing',
        'witty',
    ];

    /**
     * List of Celebrities whose identities will be taken for random name easy to remember
     *
     * @var array
     */
    protected static $celebrities = [
        'Adele',
        'Alexander Skarsgard',
        'Amy Adams',
        'Angelina Jolie',
        'Anne Hathaway',
        'Ashton Kutcher',
        'Avril Lavigne',
        'Ben Affleck',
        'Beyonce Knowles',
        'Brad Pitt',
        'Bradley Cooper',
        'Britney Spears',
        'Brooke Shields',
        'Bruce Willis',
        'Celine Dion',
        'Cameron Diaz',
        'Carmen Electra',
        'Cate Blanchett',
        'Catherine Zeta-Jones',
        'Channing Tatum',
        'Charlie Sheen',
        'Charlize Theron',
        'Chris Brown',
        'Chris Hemsworth',
        'Chris Pine',
        'Christian Bale',
        'Christina Aguilera',
        'Colin Farrell',
        'Colin Firth',
        'Courteney Cox',
        'Dakota Fanning',
        'Daniel Craig',
        'Daniel Radcliffe',
        'David Beckham',
        'Demi Moore',
        'Denise Richards',
        'Denzel Washington',
        'Diddy',
        'Drew Barrymore',
        'Ellen DeGeneres',
        'Emily Blunt',
        'Emma Roberts',
        'Emma Stone',
        'Emma Watson',
        'Eva Mendes',
        'Fergie',
        'George Clooney',
        'Gerard Butler',
        'Gwen Stefani',
        'Gwyneth Paltrow',
        'Halle Berry',
        'Heidi Klum',
        'Hugh Jackman',
        'Janet Jackson',
        'Jennifer Aniston',
        'Jennifer Garner',
        'Jennifer Lawrence',
        'Jennifer Lopez',
        'Jessica Alba',
        'Jessica Chastain',
        'Jessica Simpson',
        'Johnny Depp',
        'Jude Law',
        'Julia Roberts',
        'Justin Bieber',
        'Justin Timberlake',
        'Kanye West',
        'Kate Moss',
        'Kate Winslet',
        'Katy Perry',
        'Keanu Reeves',
        'Keira Knightley',
        'Kerry Washington',
        'Khloe Kardashian',
        'Kim Kardashian',
        'Kirsten Dunst',
        'Kourtney Kardashian',
        'Kristen Stewart',
        'Lady Gaga',
        'Leonardo DiCaprio',
        'Liam Hemsworth',
        'Lindsay Lohan',
        'Liv Tyler',
        'Lucy Liu',
        'Madonna',
        'Maggie Gyllenhaal',
        'Mariah Carey',
        'Mark Wahlberg',
        'Matt Damon',
        'Matthew McConaughey',
        'Megan Fox',
        'Mila Kunis',
        'Miley Cyrus',
        'Naomi Campbell',
        'Naomi Watts',
        'Natalie Portman',
        'Nicole Kidman',
        'Olivia Wilde',
        'Oprah Winfrey',
        'Orlando Bloom',
        'Owen Wilson',
        'Pamela Anderson',
        'Paris Hilton',
        'Penelope Cruz',
        'Pink',
        'Queen Latifah',
        'Rachel McAdams',
        'Reese Witherspoon',
        'Renee Zellweger',
        'Rihanna',
        'Robert Pattinson',
        'Rosario Dawson',
        'Ryan Gosling',
        'Ryan Phillippe',
        'Ryan Reynolds',
        'Salma Hayek',
        'Sandra Bullock',
        'Sarah Jessica Parker',
        'Sarah Michelle Gellar',
        'Scarlett Johansson',
        'Selena Gomez',
        'Shakira',
        'Shia LaBeouf',
        'Sienna Miller',
        'Taylor Swift',
        'Tiger Woods',
        'Tina Fey',
        'Tom Cruise',
        'Tyra Banks',
        'Usher',
        'Victoria Beckham',
        'Vince Vaughn',
        'Will Smith',
        'Winona Ryder',
        'Zoe Saldana'
    ];

    /**
     * Get random unique Celebrity name.
     * A list of already existing celebrities can be provided to maintain uniqueness.
     *
     * @param array $existing
     *
     * @return string
     */
    public static function getRandomCelebrity(&$existing = []){
        $i = 0;
        if(!$existing){
            $existing = [];
        }
        do{
            $char = sprintf('%s %s',
                mb_convert_case(self::$adjectives[ array_rand(self::$adjectives) ], MB_CASE_TITLE, "UTF-8"),
                self::$celebrities[ array_rand(self::$celebrities) ]);
            if($i++ > 100){
                $char = '';
                break;
            }
        }while(array_search($char, $existing) !== false);

        if($char){
            $existing[] = $char;
        }

        return $char;
    }

    /**
     * Get random unique Celebrity name slug.
     * A list of already existing celebrities can be provided to maintain uniqueness.
     *
     * @param string $separator
     * @param array $existing
     *
     * @return string
     */
    public static function getRandomCelebritySlug($separator = '-', &$existing = []){
        $i = 0;
        if(!$existing){
            $existing = [];
        }
        do{
            $char = sprintf('%s %s',
                self::$adjectives[ array_rand(self::$adjectives) ],
                self::$celebrities[ array_rand(self::$celebrities) ]
            );
            if($i++ > 100){
                $char = '';
                break;
            }
            $char = mb_convert_case($char, MB_CASE_LOWER, "UTF-8");
            $char = preg_replace('/[^\w\d]+/u', $separator, $char);
        }while(array_search($char, $existing) !== false);

        if($char){
            $existing[] = $char;
        }

        return $char;
    }

    /**
     * Get random string consisting of provided characters
     * 
     * @param int $length
     * @param string $characters
     *
     * @return string
     */
    public static function getRandomString($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }    
}