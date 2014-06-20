Plugin Moodle WPensar
=========

Instalação
---

### Via git

```
cd path/to/moodle/local
git clone git@github.com:WPensar4u/wpensar_plugin_moodle.git
```

### Arquivo zip

Baixe o plugin [wpensar_plugin_moodle.zip] e salve na pasta `local` do seu moodle.

Acesse a home do Moodle como Administrador para instalar o plugin.


Configuração
---

1. Habilite o plugin Web Service do Moodle
1. Crie um usuário específico para o acesso no Moodle via Web Service
1. Crie um token para o usuário criado vinculado ao serviço do WPensar
1. No WPensar, coloque o link do seu sistema Moodle no menu *Configurações*
1. No WPensar, coloque o token do usuário criado no menu *Configurações*

Uso
---

Por enquanto só a criação e edição de usuário está habilitada, portanto, ao criar um aluno ou editar suas informações, 
os dados serão enviados automaticamente para o seu sistema Moodle.


[wpensar_plugin_moodle.zip]:https://github.com/WPensar4u/wpensar_plugin_moodle/archive/master.zip
