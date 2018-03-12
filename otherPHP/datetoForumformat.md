# Функция для преобразования даты в формат форумов (опубликовано вчера/сегодня и т.д.) + месяц на русском языке 

```
function dateToForumFormat($a) 
{
        $nmonth = array(
            "01"=>"января",
            "02"=>"февраля",
            "03"=>"марта",
            "04"=>"апреля",
            "05"=>"мая",
            "06"=>"июня",
            "07"=>"июля",
            "08"=>"августа",
            "09"=>"сентября",
            "10"=>"октября",
            "11"=>"ноября",
            "12"=>"декабря",
        );
        $tm = date('H:i', $a);
        $d = date('d', $a);
        $m = date('m', $a);
        $y = date('Y', $a);
        foreach ($nmonth as $key => $value) {
            if($key == intval($m)) $m_human = $value;
        }
        if($d.$m.$y == date('dmY')) return "Сегодня в $tm";
		elseif($d.$m.$y == date('dmY', strtotime('-1 day'))) return "Вчера в $tm";
		elseif($y == date('Y')) return "$d $m_human, $tm";
        else return "$d $m_human $y, $tm";
    }
```