<?php
/**
 * Фабрика всех валидаторов
 *
 * @author      Андрей Г. Воронов <andreyv@gladcode.ru>
 * @copyright   Copyright © 2013, Андрей Г. Воронов
 *              Является частью плагина funcPack
 *
 * @version     ProblemPony RC 1 от 11.10.13 20:04
 */
class FactoryValidator {

    /**
     * Базовый валидатор, проверяющий текущее значение на соответствие значениям {@link xTrueValue} или {@link xFalseValue},
     * указанным в соответствующих атрибутах. То есть проверяемое значение должно быть либо истинным, либо ложным, причем
     * возможна строгая проверка вместе с соответствием типа, возможность устанавливается свойством {@link bStrict}.
     * <br><br>
     * В случае возникновения ошибки валидатор возвращает значение FALSE. Если для валидатор установлено сообщение, то оно
     * будет выведено методом AddErrorSingle модуля {@link Message}.
     * Для валидатора используются следующие модификаторы:
     * <ul>
     * <li><b>true</b>: значение, которое считается истинным, устанавивает свойство {@link xTrueValue} (по умолчанию 1)</li>
     * <li><b>false</b>: значение, которое считается ложным, устанавивает свойство {@link xFalseValue} (по умолчанию 0)</li>
     * <li><b>strict</b>: проверять значение по типу или нет (по умолчанию FALSE)</li>
     * <li><b>empty</b>: разрешать ли пустые значения (по умолчанию TRUE)</li>
     * <li><b>message</b>: сообщение, которое будет вызвано при ошибке валидации, если не указано, то выведется сообщение по
     * умолчанию</li>
     * <li><b>value</b>: проверяемое значение</li>
     * </ul>
     */
    const BASE_BOOL = 'bool';
    /**
     * Базовый валидатор, проверяет, что переданное значение является валидным url
     * <br><br>
     * В случае возникновения ошибки валидатор возвращает значение FALSE. Если для валидатор установлено сообщение, то оно
     * будет выведено методом AddErrorSingle модуля {@link Message}.
     * Для валидатора используются следующие модификаторы:
     * <ul>
     * <li><b>validSchemes</b>: массив валидных схем URI (по умолчанию ['http', 'https'])</li>
     * <li><b>validateIDN</b>: Проверять ли домены представленные как IDN (internationalized domain names), ели ложь, то
     * IDN домены всегда будут невалидными при проверке (по умолчанию FALSE)</li>
     * <li><b>empty</b>: разрешать ли пустые значения (по умолчанию TRUE)</li>
     * <li><b>message</b>: сообщение, которое будет вызвано при ошибке валидации, если не указано, то выведется сообщение по
     * умолчанию</li>
     * <li><b>value</b>: проверяемое значение</li>
     * </ul>
     */
    const BASE_URL = 'url';
    /**
     * Базовый валидатор, сравнивает два значения. Значения могут сравниваться строго - {@link strict}, или нет. Для
     * валидатора определены следующие модификаторы
     * <ul>
     * <li><b>value</b>: проверяемое значение.</li>
     * <li><b>required</b>: необходимое значение с которым сравнивается проверяемое значение.</li>
     * <li><b>strict</b>: проверять значение по типу или нет (по умолчанию FALSE)</li>
     * <li><b>empty</b>: разрешать ли пустые значения (по умолчанию TRUE)</li>
     * <li><b>message</b>: сообщение, которое будет вызвано при ошибке валидации, если не указано, то выведется сообщение по
     * умолчанию</li>
     * <li><b>operator</b>: оператор сравнения. По умолчанию '='. Может принимать следующие значения:
     *                          <ol>
     *                              <li>'=' или '==': проверяет значение на равенство. Если {@link bStrict} ИСТИНА, то
     *                              проверяется на раввенство еще и тип этих значений.</li>
     *                              <li>'!=': проверяет значение на НЕ равенство. Если {@link bStrict} ИСТИНА, то
     *                              проверяется на НЕ равенство еще и по типу этих значений.</li>
     *                              <li>'>': проверка на больше</li>
     *                              <li>'>=': проверка на больше или равно</li>
     *                              <li>'<': проверка на меньше</li>
     *                              <li>'<=': проверка на меньше или равно</li>
     *                          </ol>
     *</li>
     *</ul>
     */
    const BASE_COMPARE = 'compare';
    /**
     * Базовый валидатор, сравнивает дату (время или datetime) на соответствие формату, а также сравнивает даты на
     * больше-меньше-равно.
     * <br><br>
     * <ul>
     * <li><b>value</b>: проверяемая дата.</li>
     * <li><b>required</b>: необходимая дата с которой сравнивается проверяемая.</li>
     * <li><b>format</b>: формат даты, которому должно соответствовать проверяемое значениеПодефолту = 'dd.MM.yyyy'.
     * Более подробно в описании {@link CDateTimeParser}</li>
     * <li><b>empty</b>: разрешать ли пустые значения (по умолчанию TRUE)</li>
     * <li><b>message</b>: сообщение, которое будет вызвано при ошибке валидации, если не указано, то выведется сообщение по
     * умолчанию</li>
     * <li><b>operator</b>: оператор сравнения. По умолчанию '='. Может принимать следующие значения:
     *                          <ol>
     *                              <li>'=' или '==': проверяет значение на равенство. Если {@link bStrict} ИСТИНА, то
     *                              проверяется на раввенство еще и тип этих значений.</li>
     *                              <li>'!=': проверяет значение на НЕ равенство. Если {@link bStrict} ИСТИНА, то
     *                              проверяется на НЕ равенство еще и по типу этих значений.</li>
     *                              <li>'>': проверка на больше</li>
     *                              <li>'>=': проверка на больше или равно</li>
     *                              <li>'<': проверка на меньше</li>
     *                              <li>'<=': проверка на меньше или равно</li>
     *                          </ol>
     *</li>
     *</ul>
     */
    const BASE_DATE = 'date';
    /**
     * Базовый валидатор, проверяет текущее значение на соответствие типу {@link type}.
     * <br><br>
     * Поддерживаются следующие типы:
     * <ul>
     *      <li><b>integer</b>: знаковое целое.</li>
     *      <li><b>float</b>: вещественный тип.</li>
     *      <li><b>string</b>: строковый тип.</li>
     *      <li><b>array</b>: массив </li>
     *      <li><b>date</b>: дата</li>
     *      <li><b>time</b>: время</li>
     *      <li><b>datetime</b>: дата-время</li>
     * </ul>
     *
     * Для даты должен быть определн формат проверки, так как он указан в {@link CDateValidator}, по умолчанию 'dd.MM.yyyy'
     * <br><br>
     * Для валидатора используются следующие модификаторы:
     * <ul>
     *      <li><b>type</b>: тип, на совпадение с которым проверяется значение (см. список типов выше)</li>
     *      <li><b>dateFormat</b>: формат даты, которому должно соответствовать проверяемое значение, по дефолту = 'dd.MM.yyyy'.</li>
     *      <li><b>timeFormat</b>: формат даты, которому должно соответствовать проверяемое значение. по дефолту = 'hh:mm'.</li>
     *      <li><b>dateTimeFormat</b>: формат даты, которому должно соответствовать проверяемое значение, по дефолту = 'dd.MM.yyyy hh:mm'.</li>
     *      <li><b>strict</b>: проверять значение по типу или нет (по умолчанию FALSE)</li>
     *      <li><b>empty</b>: разрешать ли пустые значения (по умолчанию FALSE)</li>
     *      <li><b>message</b>: сообщение, которое будет вызвано при ошибке валидации, если не указано, то выведется сообщение по умолчанию</li>
     *      <li><b>value</b>: проверяемое значение</li>
     * </ul>
     */
    const BASE_TYPE = 'type';
    /**
     * Список используемых валидаторов
     * @var array
     */
    private $_aValidatorList = [
        self::BASE_BOOL    => 'ValidatorBoolean',
        self::BASE_URL     => 'ValidatorUrl',
        self::BASE_COMPARE => 'ValidatorCompare',
        self::BASE_DATE    => 'ValidatorDate',
        self::BASE_TYPE    => 'ValidatorType',
    ];
    /**
     * Текущий экземпляр главного класса валидаторов.
     * @var FactoryValidator
     */
    static protected $oInstance = NULL;

    /**
     * Ограничиваем объект только одним экземпляром.
     * @return FactoryValidator
     */
    static public function getInstance() {
        if (isset(self::$oInstance) && (self::$oInstance instanceof self)) {
            return self::$oInstance;
        } else {
            self::$oInstance = new self();
            return self::$oInstance;
        }
    }

    /**
     * Возвращает массив валидаторов и имен их классов
     * @return array
     */
    final public function getValidatorsList() {
        return $this->_aValidatorList;
    }

    /**
     * Возвращает нужный валидатор, в соответствии с переданными настройками
     * @param $aValidatorSettings Настройки валидатора
     * @return FactoryValidator|null
     */
    final public function getValidator($aValidatorSettings) {
        // Существует ли имя валидатора
        if (!isset($aValidatorSettings[0])) {
            return NULL;
        }

        // Существует ли валидатор в списке классов
        if (!isset($this->getValidatorsList()[$aValidatorSettings[0]])) {
            return NULL;
        }

        // Существует ли файл валидатора, если да, то подключим его
        /** @var string $sClassName Имя класса текущего валидатора */
        $sClassName = $this->getValidatorsList()[$aValidatorSettings[0]];
        /** @var string $sFileName Имя текущего файла валидатора */
        $sFileName = dirname(__FILE__) . '/' . $sClassName . '.class.php';
        if (!file_exists($sFileName)) {
            return NULL;
        }
        /** @noinspection PhpIncludeInspection */
        include_once $sFileName;

        // Создадим валидатор
        /** @var Validator $oValidator Валидатор данного значения */
        $oValidator = new $sClassName;
        if (!$oValidator) {
            return NULL;
        }

        // Заполняем свойства валидатора
        /** @var string $sModifierName Имя текущего свойства валидатора */
        /** @var mixed $xPropertyValue Имя текущего свойства валидатора */
        foreach ($aValidatorSettings as $sModifierName => $xPropertyValue) {
            // Пропустим имя валидатора в списке настроек
            if (!$sModifierName) {
                continue;
            }
            // Известен ли модификатор
            /** @var array $aModifier Массив модификаторов текущего валидатора */
            $aModifier = $oValidator->getModifiers();
            if (!isset($aModifier[$sModifierName])) {
                continue;
            }

            // Установим свойство объекта, если имя свойства корректно
            /** @var string $sPropertyName Имя текущего свойства валидатора */
            $sPropertyName = $aModifier[$sModifierName];
            if (property_exists($sClassName, $sPropertyName)) {
                $oValidator->$sPropertyName = $xPropertyValue;
            }
        }

        // Вернем валидатор
        return $oValidator;
    }
}

/**
 * Алиас для FactoryValidator
 */
class FV extends FactoryValidator {

}