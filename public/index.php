<?php
    require __DIR__ . '/../vendor/autoload.php';
     
     
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;
     
     
    use \LINE\LINEBot;
    use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
    use \LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
    use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
    use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
    use \LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
    use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
    use \LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
    use \LINE\LINEBot\SignatureValidator as SignatureValidator;
     
     
    $pass_signature = true;
     
     
    // set LINE channel_access_token and channel_secret
    $channel_access_token = "2qLZbb6E6fPObQLnQEGi6BzUtNgvIAAhC0iWWunqz6eiK/M+ljwIIkiXnnJXDpRwVwBzYCndoSrEqQaexkJykPj4Bfg7otOSfB3RnN9Qls4x7X+PTM3T8qEKicptZmSrjLTpKpvH2veGHVxT27mfUgdB04t89/1O/w1cDnyilFU=";
    $channel_secret = "e5c6e9aa55d59d1534ac7a10842036cf";
     
     
    // inisiasi objek bot
    $httpClient = new CurlHTTPClient($channel_access_token);
    $bot = new LINEBot($httpClient, ['channelSecret' => $channel_secret]);
     
     
     
     
    $app = AppFactory::create();
    $app->setBasePath("/public");
     
     
     
     
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello World!");
        return $response;
    });
     
     
    // buat route untuk webhook
    $app->post('/webhook', function (Request $request, Response $response) use ($channel_secret, $bot, $httpClient, $pass_signature) {
        // get request body and line signature header
        $body = $request->getBody();
        $signature = $request->getHeaderLine('HTTP_X_LINE_SIGNATURE');
     
     
        // log body and signature
        file_put_contents('php://stderr', 'Body: ' . $body);
     
     
        if ($pass_signature === false) {
            // is LINE_SIGNATURE exists in request header?
            if (empty($signature)) {
                return $response->withStatus(400, 'Signature not set');
            }
     
     
            // is this request comes from LINE?
            if (!SignatureValidator::validateSignature($body, $channel_secret, $signature)) {
                return $response->withStatus(400, 'Invalid signature');
            }
        }
     
     
        $data = json_decode($body, true);
        if(is_array($data['events'])){
            foreach ($data['events'] as $event)
            {
                if ($event['type'] == 'message')
                {
                    if($event['message']['type'] == 'text')
                    
                    {
                        if (strtolower($event['message']['text']) == "menu utama")
                        {
                            {
                                // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Bot ini menyajikan data terkait covid-19 di Indonesia\n1. Kasus Nasional\n2. DKI Jakarta\n3. Jawa Timur\n4. Jawa Barat\n5. Jawa Tengah\n6. Sulawesi Selatan\n7. Sulawesi Utara\n8. Sulawesi Tengah\n9. Sulawesi Barat\n10. Sulawesi Tenggara\n11. Kalimantan Timur\n12. Kalimantan Selatan\n13. Kalimantan Tengah\n14. Kalimantan Utara\n15. Kalimantan Barat\n16. Sumatera Barat\n17. Sumatera Utara\n18. Sumatera Selatan\n19. Kepulauan Bangka Belitung\n20. Riau\n21. Kepulauan Riau\n22. Bali\n23. Daerah Istimewa Yogyakarta\n24. Lampung\n25. Aceh\n26. Banten\n27. Papua\n28. Papua Barat\n29. Maluku\n30. Maluku Utara\n31. Nusa Tenggara Barat\n32. Nusa Tenggara Timur\n33. Gorontalo\n34. Bengkulu\n35. Jambi\n\nketik 'info' untuk menampilkan flex message\nketik 'tentang' untuk melihat informasi terkait bot dan pengembang\nketik 'Perkenalan' agar bot ini dapat memperkenalkan diri dan menjelaskan fungsinya kepada kamu\nketik 'kasus nasional' untuk melihat kasus perkembangan covid-19 di Indonesia\n\nketik salah satu nomor untuk menapilkan data");
             
                                // or we can use replyMessage() instead to send reply message
                                // $textMessageBuilder = new TextMessageBuilder($event['message']['text']);
                                // $result = $bot->replyMessage($event['replyToken'], $textMessageBuilder);
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());
                            }

                        

                        }

                        elseif ($event['message']['text'] == "1") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "743.198 Kasus Terkonfirmasi\n109.963 Kasus Aktif\n611.097 Sembuh\n22.138 Meninggal\nUpdate: 31 Desember 2020\nSumber: covid-19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "2") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "DKI Jakarta,\n183.735 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "3") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Jawa Timur,\n84.152 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "4") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Jawa Barat,\n83.579 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "5") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Jawa Tengah,\n81.716 kasus per 31 Desember 2020\nsumber: covid19.go.id");
         
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "6") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sulawesi Selatan,\n31.047 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "7") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sulawesi Utara,\n9.671 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "8") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sulawesi Tengah,\n3.552 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "9") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sulawesi Barat,\n1.941 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "10") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sulawesi Tenggara,\n7.907 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "11") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kalimantan Timur,\n27.076 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "12") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kalimantan Selatan,\n15.303 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "13") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kalimantan Tengah,\n9.740 kasus per 31 Desember 2020\nsumber: covid19.go.id");
           
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "14") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kalimantan Utara,\n3.794 kasus per 31 Desember 2020\nsumber: covid19.go.id");
        
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "15") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kalimantan Barat,\n3.118 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "16") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sumatera Barat,\n23.464 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "17") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sumatera Utara,\n18.149 kasus per 31 Desember 2020\nsumber: covid19.go.id");
           
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "18") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Sumatera Selatan,\n11.826 kasus per 31 Desember 2020\nsumber: covid19.go.id");
           
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "19") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kepulauan Bangka Belitung,\n2.337 kasus per 31 Desember 2020\nsumber: covid19.go.id");
            
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "20") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Riau,\n24.966 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "21") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Kepulauan Riau,\n6.995 kasus per 31 Desember 2020\nsumber: covid19.go.id");
           
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "22") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Bali,\n17.593 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "23") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Daerah Istimewa Yogyakarta,\n12.155 kasus per 31 Desember 2020\nsumber: covid19.go.id");
            
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "24") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']); 
                                $result = $bot->replyText($event['replyToken'], "Lampung,\n6.276 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "25") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Aceh,\n8.746 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "26") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Banten,\n18.170 kasus per 31 Desember 2020\nsumber: covid19.go.id");
                                
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "27") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Papua,\n13.126 kasus per 31 Desember 2020\nsumber: covid19.go.id");
                     
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "28") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Papua Barat,\n5.979 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "29") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Maluku,\n5.772 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "30") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Maluku Utara,\n2.771 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "31") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Nusa Tenggara Barat,\n5.664 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "32") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Nusa Tenggara Timur,\n2.167 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "33") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Gorontalo,\n3.841 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "34") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Bengkulu,\n3.603 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif ($event['message']['text'] == "35") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Jambi,\n3.227 kasus per 31 Desember 2020\nsumber: covid19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif (strtolower($event['message']['text']) == "tentang") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Bot ini dibuat oleh: Zuhal 'Alimul Hadi\nNama Bot: Covid-19 Indonesia\nDeskripsi: Bot ini menyajikan perkembangan data terkait penyebaran covid-19 di Indonesia melalui data yang diperoleh dari covid-19.go.id\nBot ini digunakan sebagai submission tugas dicoding");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif (strtolower($event['message']['text']) == "perkenalan") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "Halo, bot ini digunakan untuk melihat perkembangan data terkait covid-19 di Indonesia. Data dari bot kami diperoleh dari situs resmi covid-19.go.id\nCara untuk menggunakan bot ini dengan mengetik keyword yang ada di 'menu utama' dan pilih data yang anda inginkan");

                                $packageId = 1;
                                $stickerId = 407;
                                $stickerMessageBuilder = new StickerMessageBuilder($packageId, $stickerId);
                                $stiker = $bot->replyMessage($event['replyToken'], $stickerMessageBuilder);
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif (strtolower($event['message']['text']) == "halo") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $userId = $event['source']['userId'];
                                $getprofile = $bot->getProfile($userId);
                                $profile = $getprofile->getJSONDecodedBody();
                                $greetings = new TextMessageBuilder("Halo, " . $profile['displayName']);
                        
                                $result = $bot->replyMessage($event['replyToken'], $greetings);
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif (strtolower($event['message']['text']) == "hai") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);

                                $userId = $event['source']['userId'];
                                $getprofile = $bot->getProfile($userId);
                                $profile = $getprofile->getJSONDecodedBody();
                                $greetings = new TextMessageBuilder("Hai, " . $profile['displayName']);
                        
                                $result = $bot->replyMessage($event['replyToken'], $greetings);
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }

                        elseif (strtolower($event['message']['text']) == "kasus nasional") {
                            // send same message as reply to user
                                //$result = $bot->replyText($event['replyToken'], $event['message']['text']);
                                $result = $bot->replyText($event['replyToken'], "743.198 Kasus Terkonfirmasi\n109.963 Kasus Aktif\n611.097 Sembuh\n22.138 Meninggal\nUpdate: 31 Desember 2020\nSumber: covid-19.go.id");
             
                                $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());

                        }



                        elseif (strtolower($event['message']['text']) == 'info') {

                            $flexTemplate = file_get_contents("../flex_message.json"); // template flex message
                            $result = $httpClient->post(LINEBot::DEFAULT_ENDPOINT_BASE . '/v2/bot/message/reply', [
                                'replyToken' => $event['replyToken'],
                                'messages'   => [
                                    [
                                        'type'     => 'flex',
                                        'altText'  => 'Covid-19 Indonesia Flex Message',
                                        'contents' => json_decode($flexTemplate)
                                    ]
                                ],
                            ]);        
                    } 

                                
                        else {
                            $result = $bot->replyText($event['replyToken'], "Maaf, silahkan masukkan keyword yang benar di antara nomor 1 - 35.\n\nuntuk melihat menu ketik 'Menu Utama'\n\nuntuk melihat flex message yang ada tekan 'info'\n\nuntuk melihat informasi dan deskripsi terkait bot ketik 'tentang'\n\nketik 'Perkenalan' agar bot ini dapat memperkenalkan diri dan menjelaskan fungsinya kepada kamu\n\nketik 'kasus nasional' untuk melihat perkembangan kasus covid-19 di Indonesia");

                            $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                                return $response
                                    ->withHeader('Content-Type', 'application/json')
                                    ->withStatus($result->getHTTPStatus());
             
                        }
                    }

                    elseif (
                        $event['message']['type'] == 'image' or
                        $event['message']['type'] == 'video' or
                        $event['message']['type'] == 'audio' or
                        $event['message']['type'] == 'file'
                    ) {
                        $contentURL = " https://linebotusingphp123.herokuapp.com/public/content/" . $event['message']['id'];
                        $contentType = ucfirst($event['message']['type']);
                        $result = $bot->replyText($event['replyToken'],
                            $contentType . " yang Anda kirim bisa diakses dari link:\n " . $contentURL);
                        $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus($result->getHTTPStatus());
                    } 

                        //group room
                    elseif (
                        $event['source']['type'] == 'group' or
                        $event['source']['type'] == 'room'
                    ) {
                        //message from group / room
                        if ($event['source']['userId']) {
                    
                            $userId = $event['source']['userId'];
                            $getprofile = $bot->getProfile($userId);
                            $profile = $getprofile->getJSONDecodedBody();
                            $greetings = new TextMessageBuilder("Halo, " . $profile['displayName']);
                    
                            $result = $bot->replyMessage($event['replyToken'], $greetings);
                            $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
                            return $response
                                ->withHeader('Content-Type', 'application/json')
                                ->withStatus($result->getHTTPStatus());
                        }

                    elseif (strtolower($event['message']['text']) == 'flex message') {

                        $flexTemplate = file_get_contents("../flex_message.json"); // template flex message
                        $result = $httpClient->post(LINEBot::DEFAULT_ENDPOINT_BASE . '/v2/bot/message/reply', [
                            'replyToken' => $event['replyToken'],
                            'messages'   => [
                                [
                                    'type'     => 'flex',
                                    'altText'  => 'Test Flex Message',
                                    'contents' => json_decode($flexTemplate)
                                ]
                            ],
                        ]);        
                } 
                    else {
                        //message from single user
                        $result = $bot->replyText($event['replyToken'], $event['message']['text']);
                        $response->getBody()->write((string)$result->getJSONDecodedBody());
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus($result->getHTTPStatus());
                    }
                    
                }
            }
            return $response->withStatus(200, 'for Webhook!'); //buat ngasih response 200 ke pas verify webhook
        }
        return $response->withStatus(400, 'No event sent!');
    }});

    $app->get('/pushmessage', function ($req, $response) use ($bot) {
        // send push message to user
        $userId = 'Udba45bf0c88b31ccabacce1b802aa483';
        $textMessageBuilder = new TextMessageBuilder('Halo, ini pesan push ');
        $result = $bot->pushMessage($userId, $textMessageBuilder);
        $stickerMessageBuilder = new StickerMessageBuilder(1, 106);
        $bot->pushMessage($userId, $stickerMessageBuilder);
     
        $response->getBody()->write("Pesan push berhasil dikirim!");
        return $response
            //->withHeader('Content-Type', 'application/json')
            ->withStatus($result->getHTTPStatus());
        
        
    });
    
    $app->get('/multicast', function($req, $response) use ($bot)
    {
        // list of users
        $userList = [
            'U206d25c2ea6bd87c17655609xxxxxxxx',
            'Udba45bf0c88b31ccabacce1b802aa483',
            'zuhalalal',
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'];
     
        // send multicast message to user
        $textMessageBuilder = new TextMessageBuilder('Halo, ini pesan multicast');
        $result = $bot->multicast($userList, $textMessageBuilder);
     
     
        $response->getBody()->write("Pesan multicast berhasil dikirim");
        return $response
            //->withHeader('Content-Type', 'application/json')
            ->withStatus($result->getHTTPStatus());
    });

    $app->get('/profile', function ($req, $response) use ($bot)
    {
        // get user profile
        $userId = 'Udba45bf0c88b31ccabacce1b802aa483';
        $result = $bot->getProfile($userId);
     
        $response->getBody()->write(json_encode($result->getJSONDecodedBody()));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($result->getHTTPStatus());
    });

    $app->get('/content/{messageId}', function ($req, $response, $args) use ($bot) {
        // get message content
        $messageId = $args['messageId'];
        $result = $bot->getMessageContent($messageId);
        // set response
        $response->getBody()->write($result->getRawBody());
        return $response
            ->withHeader('Content-Type', $result->getHeader('Content-Type'))
            ->withStatus($result->getHTTPStatus());
    });


    $app->run();