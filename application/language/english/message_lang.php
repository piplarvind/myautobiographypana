<?php
	$file_path=dirname(__FILE__)."/../language-17";
	if(file_exists($file_path))
	{
		$file_content = file_get_contents($file_path);
		$arr_page_keyword=unserialize($file_content);
			$lang=array();
			if(count($arr_page_keyword['page'])>0)
			{
				foreach($arr_page_keyword['page'] as $page)
				{
					if(count($page)>0)
					{
						foreach($page as $keyword)	
						{
							$lang[$keyword['keyword_name']]=$keyword['keyword_value'];
						}
					}
				}
			}	}
	else
	{
		$lang=array();
	}