في (PHP)، تُستخدم استثناءات (exceptions) للتعامل مع الأخطاء والمواقف غير المتوقعة بطريقة منظمة. يسمح لك استخدام الاستثناءات بفصل منطق البرنامج عن معالجة الأخطاء، مما يجعل الشيفرة أكثر وضوحًا وسهولة في الصيانة.

 مفهوم الاستثناءات

عندما يحدث خطأ في البرنامج، يمكنك "رمي" استثناء باستخدام الكلمة المفتاحية `throw`. يمكن "التقاط" هذا الاستثناء باستخدام الكلمة المفتاحية `try` مع `catch`.

مثال 

php
<?php

class MyException extends Exception {}

function testException($number) {
    if ($number < 0) {
        throw new MyException("عدد سالب: $number");
    }
    return $number;
}

try {
    echo testException(5);  // سيعمل بشكل صحيح
    echo testException(-1); // سيؤدي إلى استثناء
} catch (MyException $e) {
    echo 'تم القبض على الاستثناء: ',  $e->getMessage(), "\n";
}

?>




- **تعريف الاستثناء**: قمنا بتعريف فئة استثناء مخصصة باسم `MyException` التي تمتد من فئة `Exception` الأساسية.
- **دالة `testException`**: تتحقق إذا كان الرقم أقل من صفر. إذا كان كذلك، يتم رمي استثناء.
- **كتلة `try` و `catch`**: يتم استدعاء الدالة داخل كتلة `try`. إذا تم رمي استثناء، يتم التقاطه في كتلة `catch` ويتم عرض رسالة الخطأ.

### استخدامات متقدمة

استثناءات يمكن أن تحتوي على معلومات إضافية مثل رمز الخطأ أو معلومات سياقية. يمكن استخدام ذلك لتحسين معالجة الأخطاء.

### مثال مع معلومات إضافية

```php
<?php

class DatabaseException extends Exception {}

function connectToDatabase($host, $user, $password) {
    if ($host == '' || $user == '' || $password == '') {
        throw new DatabaseException("تفاصيل الاتصال غير صحيحة");
    }
    // هنا يمكنك وضع منطق الاتصال بقاعدة البيانات
    return true;
}

try {
    connectToDatabase('', 'username', 'password');
} catch (DatabaseException $e) {
    echo 'خطأ في الاتصال بقاعدة البيانات: ', $e->getMessage(), "\n";
}

?>
```

### الشرح

- **فئة `DatabaseException`**: استثناء مخصص للتعامل مع أخطاء قواعد البيانات.
- **دالة `connectToDatabase`**: ترمي استثناء إذا كانت تفاصيل الاتصال غير صحيحة.
- **معالجة الاستثناء**: يتم عرض رسالة خطأ مخصصة عند حدوث المشكلة.

