<h1 align='center'>Criptografia_AES</h1>
<p align='center'>Registro de dados usando a criptografia AES no PHP e SQL :lock:</p>

<b>Objetivo: </b>criptografar os registros enviados para o banco de dados com AES (<i>Advanced Encryption Standard</i>). Essa técnica utiliza uma chave para crifrar e decifrar valores, com isso, está implementado a geração randômica de chaves para os registros de usuários, e o armazenamento das chaves.

Um registro criptografado com AES é basicamente assim:<br>
```sql
INSERT INTO tabela(campo) VALUES( AES_encrypt(valor_campo, chave) )
```

Para consultar a inserção acima, seria:<br>
```sql
SELECT AES_decrypt(coluna_campo, chave) as campo FROM tabela
```

Porque informamos a mesma chave para criptografar e decriptografar, existe uma tabela para guardar as chaves, relacionando com os registros dos usuários e na busca dos dados é usado INNER JOIN entre as duas tabelas, dessa forma:<br>

```php
$SQL = "SELECT AES_decrypt(Us.login, Ch.chave) as login, AES_decrypt(Us.senha, Ch.chave) as senha ";
$SQL .= "FROM usuario Us INNER JOIN  chaves Ch ON Us.id = Ch.id_usuario";
```

<b>Resultados:</b> o resultado da criptografia AES é visivelmente mais complexo que o de outros métodos como MD5, Base64 e outros. Abaixo apresenta-se um valor usado no teste como texto puro, o resultado da criptografia desse texto em outros métodos e por fim o resultado forte do AES:<br>
:arrow_right: Texto puro:</b> meuemail@mail.com<br>
:arrow_right: MD5: </b>cb7ca2fdc9159d5bc027a07bedf47ee9<br>
:arrow_right: SHA1: </b>a5332af4907ed111fcda0c70779ecbea90dd7f19<br>
:arrow_right: Base64: </b>bWV1ZW1haWxAbWFpbC5jb20=<br>
:arrow_right: AES: </b>G78j1&H%AB1%%&HABKla*19D!Xj!q8*x<br>
</ul>
