<?php
	/*---общие настройки---*/
	
	$project_name = 'WoW-Play';                            //Имя сервера
	$site_path = 'http://localhost/';                      //Адрес сервера
	$site_realmlist = 'set realmlist logon.wowplay.hol.es';//Реалмлист вашего сервера
	$site_title = 'Бесплатный сервер - '.$project_name;    //Титул сайта вервера
	$refresh_status_time = '10';                           //Время обновления статистики сервера (в секундах)
	$realm_count = '2';                                    //Кол-во реалмов
	$page_count_online = '20';                             //Кол-во игроков онлайн, отображаемых на одной странице
	$page_count_ban = '20';                                //Кол-во забаненных персонажей, отображаемых на одной странице
	$mysql_cod = 'utf8_general_ci';                        //Кодировка mysql сервера
	$wmr = 'R563065120386';                                //Кошелек
	$lang_count = '2';                                     //Кол-во языков
	$lang_name['1'] = 'Русский';                           //Названия языков
	$lang_name['2'] = 'English';
	$mysql_path['cms'] = 'localhost';                   //Адрес mysql сервера
	$mysql_login['cms'] = 'trinity';                    //Логин mysql сервера
	$mysql_password['cms'] = 'trinity';                 //Пароль mysql сервера
	$mysql_db['cms'] = 'auth';                          //Название базы аккаунтов
	
	$host = 'localhost';                                // адрес хоста БД  
	$user = 'trinity';                                  //логин   бд
	$password = 'trinity';                              //пароль бд 
	$realmdb = 'auth';                                  // название базы реалмд
	
	/*---Настройки базы данных---*/
	/*---Настройка всех реалмов аналогична*/
	
	$mysql_path['1'] = 'localhost';                     //Адрес mysql сервера
	$mysql_login['1'] = 'trinity';                      //Логин mysql сервера
	$mysql_password['1'] = 'trinity';                   //Пароль mysql сервера
	$mysql_db_characters['1'] = 'characters';           //Название базы персонажей
	$mysql_db_realmd['1'] = 'auth';                     //Название базы аккаунтов
	$mysql_db_world['1'] = 'world';                     //Название базы мира
	$realm_title['1'] = 'Алдоран';                      //Название Реалма
	$mail_sender_guid['1'] = '1';                       //ID персонажа, от которого будут отправлены письма в донат системе. Если не уверены, то не меняйте это поле
	$server_path['1'] = 'localhost';                    //Адрес сервера
	$server_port['1'] = '8085';                         //Порт сервера (8085 по умолчанию)
	$server_type['1'] = '0';                            //Тип сервера. 0 - trinity core, 1 - myth core
	$lk_shop_f['1'] = 4;                               	//Константа цены в магазине. Для рейтов х1 ~ 3-4, для х100 ~ 15-20
	$realm_re['1'] = 'x 100 PvP';                           //Рейты реалма
	$realm_ver['1'] = '3.3.5а';                         //Версия игры
	
	$mysql_path['2'] = 'localhost';                     //Адрес mysql сервера
	$mysql_login['2'] = 'trinity';                      //Логин mysql сервера
	$mysql_password['2'] = 'trinity';                   //Пароль mysql сервера
	$mysql_db_characters['2'] = 'characters';           //Название базы персонажей
	$mysql_db_realmd['2'] = 'auth';                     //Название базы аккаунтов
	$mysql_db_world['2'] = 'world';                     //Название базы мира
	$realm_title['2'] = 'Скверна';                      //Название Реалма
	$mail_sender_guid['2'] = '1';                       //ID персонажа, от которого будут отправлены письма в донат системе. Если не уверены, то не меняйте это поле
	$server_path['2'] = 'logon.wowplay.hol.es';                    //Адрес сервера
	$server_port['2'] = '8086';                         //Порт сервера (8085 по умолчанию)
	$server_type['2'] = '0';                            //Тип сервера. 0 - trinity core, 1 - myth core
	$lk_shop_f['2'] = 4;                               	//Константа цены в магазине. Для рейтов х1 ~ 3-4, для х100 ~ 15-20
	$realm_re['2'] = 'x 25 PvE';                             //Рейты реалма
	$realm_ver['2'] = '3.3.5а';                         //Версия игры
	
    // 1 реалм
	$dbip = "localhost";           	// IP mysql
	$gameport = "8085";             // игровой порт 
	$dbport = "3306";               // порт mysql 
	$dblogin = "trinity";           // логин mysql 
    $dbpass = "trinity";            // пароль mysql
	$cdb = "characters";            // название базы characters
	$rdb = "auth";                  // название базы realmd
	$saitbd = "auth";               //Название базы сайта(с новостями)
	$adminpassnews = "12345";       //Пароль администратора
    // 2 реалм
	$dbip2 = "localhost";            // IP mysql
	$gameport2 = "8086";             // игровой порт 
	$dbport2 = "3306";               // порт mysql 
	$dblogin2 = "trinity";           // логин mysql 
    $dbpass2 = "trinity";            // пароль mysql
	$cdb2 = "characters";            // название базы characters
	$rdb2 = "auth";                  // название базы realmd	
	
	$ssulkaemail = "mail:WoW-Play@gmail.com";            //Email администратора
	$ssulkaskype = "joker_alex5";                         //Skype администратора
	$ssulkaevk = "vk.com/WoW-Play";                        //Група вконтакте
	$ssulkatwitter = "twitter.com/WoW-Play";               //Твиттер сервера
	$ssulkafacebook = "facebook.com/WoW-Play";             //Фейсбук сервера
	$downloadwow = "http://wowjp.net/index/0-59";         //Ссылка на скачивание клиента
?>
