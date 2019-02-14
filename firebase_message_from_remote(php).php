$notification_details = $this->common->get_all_record('table name',array()); //get all ids from table

            if($notification_details != NULL){
                foreach ($notification_details as $notification_details_row) {
                    $registrationIds = $notification_details_row['token'];
                #prep the bundle
                    $msg = array
                        (
                        'body'  => 'body msg',
                        'title' => 'title',
                        'icon'  => 'myicon',/*Default Icon*/
                        'sound' => 'mySound'/*Default sound*/
                        );
                    $fields = array
                        (
                        'to'            => $registrationIds,
                        'notification'  => $msg
                        );
                    $headers = array
                        (
                        'Authorization: key=' . "your Firebase Server key",
                        'Content-Type: application/json'
                        );
                #Send Reponse To FireBase Server
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

                    $result = curl_exec ( $ch );
                    // echo "<pre>";print_r($result);exit;
                    curl_close ( $ch );
                }
            }
