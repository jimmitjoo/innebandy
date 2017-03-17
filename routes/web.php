<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){

    $data = urldecode($_GET['url']);

    $client = new \Goutte\Client();

    echo '<form action="/" method="get">';
    echo '<input name="url" placeholder="Lägg in url för tabellen">';
    echo '<input type="submit" value="Skicka">';
    echo '</form>';

    $crawler = $client->request('GET', $data);

    echo '<table>';
    $crawler->filter('.clCommonGrid.clTblStandings.clTblWithFullToggle tbody tr')->each(function ($node) {
        //print $node->html()."\n";

        echo '<tr>';

        $node->filter('td:nth-child(2)')->each(function ($n) {
            echo '<td>' . $n->text() . '</td>';

            $club = \App\Club::where('name', $n->text())->first();
            if (!$club) {
                $club = new \App\Club();
                $club->name = $n->text();
                $club->save();
            }
        });

        /*$i=0;
        $node->filter('td:not(.ext)')->each(function ($n) use($i) {
            echo '<td>' . $i . ' - ' . $n->text() . '</td>';
            $i++;
        });*/

        echo '</tr>';


    });
    echo '</table>';
    return;

    dd($crawler);

    return 'lol';
});

Route::resource('/clubs', 'ClubController');

/*
Route::get('/', function () {
    return view('welcome');
});
*/