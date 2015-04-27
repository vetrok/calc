<?php
namespace application\controllers;

class SmenaController implements ControllerAncestor
{
    /**
     *middleHTML - Свойство содержащее название HTML файла отрисовыввающего центральную часть страницы
     *
     *userData - данные присланные пользователем первый рабочий день, график и тд
     *
     * currDtime - текущий день\месяц\год
     */
    protected $_middleHTML = [];
    protected static $_meta = [];
    protected $_userData = [];
    protected $_currDtime= [];

    public function indexAction()
    {
    /**
     *indexAction показывает форму для ввода данных.
     *Без JS делаю простой select с актуальным на данный момент
     * кол-вом дней в месяце + текущий месяц + текущий год +
     * кол-во рабочих дней и кол-во выходных : напр(3 через 3)
     * default-selected на текущую дату
     */
        $front = FrontController::getInstance();
        $view = new \application\models\View();
        //Кол-во дней в месяце , текущий месяц, текущий день
        $this->_currDtime['day'] = (int)date('d');
        $this->_currDtime['days'] = date('t');
        $this->_currDtime['month'] = date('m');
        $this->_currDtime['year'] = date('Y');
        $front->setBody(
            $view->render($this->getMiddleHTML()['index'],
                $this->getCurrDtime(),
                static::getMeta()
            )
        );
    }

    public function createAction()
    {
        /**
         *Метод для создания нового расчёта
         */
        if ($_SERVER['REQUEST_METHOD'] != 'POST' or empty($_POST)) {
            /**
            *

            if ($_COOKIE[$this->getMeta()['cookieName']]) {
                $this->_userData = Usefull::unserialize($_COOKIE[$this->getMeta()['cookieName']]);
                $x = $this->interpritateTimestamp($this->_userData, time());
                /*echo date("d:m:Y", $this->_userData['time']);
                echo date("d:m:Y", $x['time']);
                $time = date('j:n:Y', $x['time']);
                $t = explode(":", $time);
                $time = mktime(
                    0,
                    0,
                    0,
                    $t[1],
                    $t[0],
                    $t[2]
                );
                $this->_userData['time'] = $time;
                setcookie(
                    $this->getMeta()['cookieName'],
                    Usefull::serialize($this->_userData),
                    $this->getMeta()['cookieLife']
                );
            } else {
                $this->indexAction();

            }*/
            $this->indexAction();
        } else {
            /**
             *Принимаю и фильтрую данные
             */
            $this->_userData['work'] = Usefull::clearInt($_POST['work']);
            $this->_userData['rest'] = Usefull::clearInt($_POST['rest']);
            $day = Usefull::clearInt($_POST['day']);
            $month = Usefull::clearInt($_POST['month']);
            $year = Usefull::clearInt($_POST['year']);
            $this->_userData['time'] = mktime(
                0,
                0,
                0,
                $month,
                $day,
                $year,
                0
            );
            /**
             *Сохраняю введённые данные при помощи cookie
             *
             * надо будет думать о регистрации и БД:)
             */
            setcookie(
                static::getMeta()['cookieName'],
                Usefull::serialize($this->_userData),
                static::getMeta()['cookieLife'],
                '/'
            );
            /**
            *Вот хочю я ищё на интерпритацию отдать для проверки!

            echo date('d m Y', $this->_userData['time']);
            $this->_userData = $this->interpritateTimestamp($this->_userData, $this->_userData['time']);
            echo date('d m Y', $this->_userData['time']);
             */
            /**
             *Вызываю метод для расчёта текущего месяца
             */
            $arr = $this->getMonth($this->_userData);
            $front = FrontController::getInstance();
            $view = new \application\models\View();
            /**
             *$data двуммерный массив где элемент 0 = timestamp() запрошенного
             *пользователем месяца для расчёта р\в
             *элемент 1 = сам массив
             */
            $data[0] = $this->_userData['time'];
            $data[1] = $arr;
            $front->setBody(
                $view->render(
                    $this->getMiddleHTML()['create'],
                    $data,
                    static::getMeta()
                )
            );
        }
    }

    public function showAction()
    {
        /**
        *Мэтод рисует текущий месяц - взяв данные с кук и запихивает в куку
         * новый ТС
         */
        if ($_COOKIE[static::getMeta()['cookieName']]) {
            $this->_userData = array_map(
                '\application\controllers\Usefull::clearStr',
                Usefull::unserialize($_COOKIE[static::getMeta()['cookieName']])
            );
            $t = [];
            $x = 0;
            $var = 0;
            $front = FrontController::getInstance();
            if ($front->getParams()[static::getMeta()['next']] == 1) {
                $var = 1;
            } elseif ($front->getParams()[static::getMeta()['prev']] == 1) {
                $var = -1;
            }
            $t = explode(":", date('j:n:Y', $this->_userData['time']));
            $time = mktime(
                0,
                0,
                0,
                $t[1] + $var,
                $t[0],
                $t[2],
                0
            );
            $x = $this->interpritateTimestamp($this->_userData, $time);
            //$time = date('j:n:Y', $x['time']);
            /**
            *это я время в 0 сбрасую)
             */
            $t = explode(":", date('j:n:Y', $x['time']));
            $time = mktime(
                0,
                0,
                0,
                $t[1],
                $t[0],
                $t[2],
                0
            );
            $this->_userData['time'] = $time;
            setcookie(
                static::getMeta()['cookieName'],
                Usefull::serialize($this->_userData),
                static::getMeta()['cookieLife'],
                '/'
            );
            /**
            *Вывожу данные
             */
            $arr = $this->getMonth($this->_userData);
            $front = FrontController::getInstance();
            $view = new \application\models\View();
            $data[0] = $this->_userData['time'];
            $data[1] = $arr;
            $front->getParams();
            $front->setBody(
                $view->render(
                    $this->getMiddleHTML()['create'],
                    $data,
                    static::getMeta()
                )
            );

        } else {
            $this->indexAction();
        }
    }

    public static function getMonth(Array $user)
    {
    /**
     *Принимаю массив по шаблону с формы
     * для того чтобы вернуть индексированный массив с значениями
     * w - рабочий день
     * r - выходной
     */
        if (
            empty($user) and
            empty($data)
        ) {
            /**
             *ЗДЕСЬ ДУМАЕМ ЧТО С ОШИБКОЙ ДЕЛАТЬ!!!!!
             */
            $err = "Файл: ".__FILE__.
                ". Строка: ".__LINE__.
                ". Исключительная ситуация - пустой массив с Формы";
            trigger_error($err);
        }
        /**
        *Узнаю сколько дней в месяце из $date и какой сейчяс день
         * Забиваю массив сначала до конца месяца , потом до начала...
         */
        $daysInMonth = date('t', $user['time']);
        $currDay = (int)date('j', $user['time']) - 1;
        $arr = array();
        $work = $user['work'];
        $rest = $user['rest'];
        /**
        *в формуле узнаю остаток от деления текущего дня от суммы рабочий\выходной
         * если остаток есть , это значит что сколько дней надо учесть... т.е.
         * от суммы work + rest отнять остаток!
         */
        $formula = $currDay % ($work + $rest);
        $ostatok = ($work + $rest) - $formula;
        $work -= $ostatok;
        if ($work < 0) {
            $rest += $work;
            $work = 0;
        }
        while ($daysInMonth--) {
            if ($work) {
                $arr[] = 'w';
                $work--;
            } elseif ($rest) {
                $arr[] = 'r';
                $rest--;
            } else {
                $rest = $user['rest'];
                $work = $user['work'];
                $daysInMonth++;
            }
        }
        return $arr;
    }

    public static function interpritateTimestamp($user, $new)
    {
        /**
        *Надо в цикле прогнать от начальной точки до требуемой
         * пока думаю по дням работать...
         * момент что нужно сюда слать стемп с запасиком - не 1 день месяца,
         * а хотябы 15-20 чтобы правильно обработать - ведь getMonth()
         * если примет 30 число то он этот месяц рисовать будет!а в 30 я могу скотиться
         * если! буду искать первый рабочий день а он окажется в предыдущем месяце+
         * могу скотится если буду разницу округлять(обычно в меньшую округляется)
         * т.е. у меня исходный тс 0:00:00 а мне придёт плохой - хотя не норм буит
         * полночь рулит) даже округляя то всёравно тот дже день получю....
         * отымаю 2 ТС остаток получаю дни - сколько в цикле их и проганяю
         * (а зачем цикл лучше просто поделить и от остатка найти первый рабочий тай ппц)
         * там походу формулкой решится всё)))
         *
         * потом надо найти в том что получил первый рабочий день - как
         * в форме - и уже слать дальше!
         * Принимаю
         * $user - данные введённые пользователем -
         * первый рабочий день(таймстэмп) + график (3\3 например)
         * $new - новый timestamp пойдёт в метод getMonth()
         */
        if (empty($user) or empty($new)) {
            echo "EMPTY VALUSE FOR " . __METHOD__;
        }
        //Мне надо чтобы в новом ТС было не любое число а 15 для избежания ситуации с 1-31 числами
        $d = explode(':', date('n:Y', $new));
        $new = mktime(
            0,
            0,
            0,
            $d[0],
            15,
            $d[1],
            0
        );
        //ОШИБКИ ОТРАБОТАТЬ!
        $add = 0;
        $ostatok = 0;
        $diff = $new - $user['time'];
        $diff = ($diff/86400);
        if ($diff == 0) {
            return $user;
        } elseif ($diff > 0) {
            $wPlusR = $user['work'] + $user['rest'];
            //Это сколько смен не прошло по полному циклу для дня в таймстэмп()новом
            $ostatok = (int)($diff % $wPlusR);
            if ($ostatok) {
                //Это сколько дней надо добавить к новому ТС чтобы получить первый рабочий день!
                $add = ($wPlusR - $ostatok) * 86400;
            }
            $user['time'] = $new + $add;
            return $user;
        } else {
            $wPlusR = $user['work'] + $user['rest'];
            $ostatok = (int)($diff % $wPlusR);
            $user['time'] = $new - ($ostatok * 86400);
            return $user;
        }

        /**
        *о5 таки делим с остатком остаток - напр 5 это мол 3 рабочих и 2 выходных
         * прошло в смене 3\3 надо мои ВОРК+РЕСТ потом от них отнять
         * остаток кол-во * 86400 и добавить к тайм стэмп - это
         * я получу первый рабочий день в этом месяце дальше всё работаем)
         */

    }

    public function getMiddleHTML()
    {
        $this->_middleHTML['index'] = 'middleSmenaIndex.php';
        $this->_middleHTML['create'] = 'middleSmenaCreate.php';
        return $this->_middleHTML;
    }

    public static function getMeta()
    {
    /**
    *У меня дилема где зада вать данные для мета переменной ...
     */
        static::$_meta['topMenuClass'] = 'smena';
        static::$_meta['cookieName'] = 'smena';
        /**
        *Имя переменной какую я проверяю в showAction()
         * для отображения предыдущего\следующего месяца!
         */
        static::$_meta['next'] = 'next';
        static::$_meta['prev'] = 'prev';
        /**
        *кука на 300 дней
         */
        static::$_meta['cookieLife'] = time() + 25920000;
        return static::$_meta;
    }

    public function getCurrDtime()
    {
    /**
     *текущие день месяц год
     */
        return $this->_currDtime;
    }
}
