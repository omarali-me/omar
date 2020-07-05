	public function actionhappinessMeter()
	{
		$apiDescription = 'post your happiness-meter result here (mobile, webapp pfor the Hilux project';
		
		if(isset($_POST['data']))
		{
			$data = json_decode($_POST['data']);

			$happiness = new HappinessMeter;
			$happiness->dateTime = date('Y-m-d H:i:s');
			$happiness->value = $data->value;
			$happiness->deviceInfo = json_encode($data->deviceInfo);
			$happiness->sessionInfo = json_encode($data->sessionInfo);
			$happiness->userID = $data->userID;

			if($happiness->save())
			{
				$apiStatus = 'success';
				$apiResultMessage = 'Saved your happiness-log successfully. The reference ID is '.$happiness->getPrimaryKey().'.';
				$apiResultData = array();
	
				print apiResult($apiStatus,$apiResultMessage,$apiResultData);				
			}
			else
			{
				$apiStatus = 'error';
				$apiResultMessage = 'Some values are not as expected. Please see data for error details';
				$apiResultData = $happiness->getErrors();
	
				print apiResult($apiStatus,$apiResultMessage,$apiResultData);
			}
		}
		else {
			print apiResult('information',$apiDescription);
		}
	}