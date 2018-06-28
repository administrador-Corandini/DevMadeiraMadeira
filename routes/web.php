<?php


Route::get('/', function () {
    return view('auth/login');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/mm/{link}','LinkController@identificador');

Auth::routes();

Route::group(['middleware' => 'auth'],function(){


	Route::prefix('cliente')->group(function () {

		Route::get('upload',			'ClienteController@upload');
		Route::post('search',			'ClienteController@search');
		Route::get('list', 				'ClienteController@list');
		Route::get('view/{id}', 		'ClienteController@show');
		Route::get('create', 			'ClienteController@create');
		Route::get('addTelefone/{id}',	'ClienteController@addTelefone');
		Route::get('addEmail/{id}',		'ClienteController@addEmail');
		Route::get('agendaHora',		'ClienteController@agendaHoraList');
		Route::get('agendaHora/{id}',	'ClienteController@agendaHoraID');

		//Route::get('carteira/{id}/devolucao','ClienteController@devolucao');

		
		Route::post('salvaOcorrencia',	'ClienteController@salvaOcorrencia');
		Route::post('salvaTelefone',	'ClienteController@salvaTelefone');
		Route::post('salvaEmail',		'ClienteController@salvaEmail');
		Route::post('file',				'ClienteController@file');
		Route::post('salvaAddTelefone',	'ClienteController@salvaAddTelefone');
		Route::post('salvaAddEmail',	'ClienteController@salvaAddEmail');
		Route::post('agendaHora',		'ClienteController@agendaHora');

		Route::resources([
			'canal' => 'canalController'
		]);
		

	});

	
	
	Route::get('/home', 'HomeController@index');

	Route::get('/link/{id}/{tip}/{destino}/{id_produto}','LinkController@count');

	Route::prefix('admin')->group(function () {

		Route::resources([
			'user' 	=> 'UserController'
		]);

    	Route::get('clicks', 'AdminController@clicks');
		Route::get('ocorrencia', 'AdminController@ocorrencia');
		Route::get('extracao','AdminController@extracao');
		Route::get('importacao','AdminController@importacao');
		Route::any('SalvaImportacao','AdminController@SalvaImportacao');
		Route::get('/','AdminController@index');

		Route::prefix('carteira')->group(function () {
			Route::get('','CarteiraController@index');
			Route::get('{id}/edit','CarteiraController@edit');
			Route::post('salvarEdit','CarteiraController@salvarEdit');
			Route::get('{id}/devolucao','ClienteController@devolucao');
	
		});

		Route::prefix('marketplace')->group(function () {
			Route::get('','MarketplaceController@index');
			Route::get('edit/{carteira}','MarketplaceController@edit');
			Route::post('salvarEdit','MarketplaceController@salvarEdit');
		});
		
		Route::prefix('situacao')->group(function () {
			Route::get('index','SituacaoController@index');
			Route::get('/edit/{carteira}','SituacaoController@edit');
			Route::post('salvarEdit','SituacaoController@salvarEdit');
		});

	});

});






