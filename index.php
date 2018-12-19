<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once './LINEBotTiny.php';

$channelAccessToken = getenv('eZ050fUrqgMzuvZPKt1REYWZVsRImiFCpi3DujLJY/u9rIql9Y2CF+va7gHhtqYTbCR6LRb/Y3iqU75MKwfBDSYAmXCXhXmjM/hNuaD8DFV5d5aMTDhu06U1+ufDExGkJROWhQTG3zR8KO13y/QsrAdB04t89/1O/w1cDnyilFU=');
$channelSecret = getenv('98c316f65d43243f5f999423f4e8f75e');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $m_message = $message['text'];
                    if ($m_message != "") {
                        $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => $m_message,
                                ),
                            ),
                        ));
                    }
                    break;

            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
}
;
