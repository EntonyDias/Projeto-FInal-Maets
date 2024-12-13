# Maets

## Integrantes

<img src="https://github.com/Dakaua.png" width="80" height="80">

[Dã Kauã Lopes](https://github.com/Dakaua)

<img src="https://github.com/EntonyDias.png" width="80" height="80">

[Entony Dias](https://github.com/EntonyDias)

<img src="https://github.com/HigorLegal.png" width="80" height="80">

[Higor da Silva](https://github.com/HigorLegal)

---

## Índice
- [Descrição do Projeto](#descrição-do-projeto)
- [Badges](#badges)
- [Contatos](#Contatos)
---

## Descrição do Projeto
Nosso projeto refere-se a uma loja virtal de jogos eletrônicos, onde os usuarios poderão se cadastrar, logar em diferentes aparelhos, criar carrinhos de compras com diversos games diferentes e efetuar estas. Terão administradores para controlarem o fluxo e consertar possiveis falhas, além de também as desenvolvedoras que poderam por games novos assim que finalizados.

---

<!-- Link para pagina da badges -->
[Link Badges](https://ileriayo.github.io/markdown-badges/)
---

## Tecnologias Utilizadas
<!-- Badge HTML5 -->
- ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
<!-- Badge CSS3 -->
- ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
<!-- Badge PHP 8.0 -->
- ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
<!-- Badge GitHub Pages -->
- ![Github Pages](https://img.shields.io/badge/github%20pages-121013?style=for-the-badge&logo=github&logoColor=white)
<!-- Badge ChatGpt -->
- ![JavaScript](https://img.shields.io/badge/JavaScript-grey?style=for-the-badge&logo=javascript)
---

## IDEs/Editores utilizados
<!-- Badge Visual Studio Code -->
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)

## Instruções de Configuração e Execução
Para configurar e executar o projeto localmente, siga os passos abaixo:

1. Clone o repositório:
    ```bash
    git clone https://github.com/EntonyDias/Projeto-Final-Maets
    code .

---

## Funcionalidades Implementadas
- **Formulário de cadastro**
- **Banco de Dados**
- **Sistema CRUD**

---

## Contatos

<table>
  <tr>
    <th>Nome</th>
    <th>Idade</th>
    <th>Contato</th>
  </tr>
  <tr>
    <td>Dã Kauã Lopes</td>
    <td>18</td>
    <td>dalopes658@gmail.com</td>
  </tr>
  <tr>
    <td>Entony Dias</td>
    <td>18</td>
    <td>entonydias07@gmail.com</td>
  </tr>
  <tr>
    <td>Higor da Silva</td>
    <td>18</td>
    <td>higorgom002@gmail.com</td>
  </tr>
</table>

## Estrutura do Banco de Dados

Descreva o banco de dados usado no projeto, incluindo:

- **Tipo de Banco de Dados**: Relacional (MySQL).
- **Estrutura**: Cada tabela irá se aplicar a uma de nossas entidades separadamente e relacionando entre si quando necessario. Assim como haverá uma tabela para os **Usuarios** do nosso site de compras, também tem uma tabela de **Biblioteca** armazenando todas as suas compras. Além de é claro os **Usuarios** poderem criar seus próprios **Carrinhos** de compra com os **Itens**. Cada item ou **Jogo** compravel tem seu provedor ou, no nosso caso, **Desenvolvedor** que terá também sua própria **Biblioteca** com seus produtos criados para edição ou possível deletagem. Também ha um **Administrador** com sua própria tabela de banco de dados. Este será responsável por gerir o site, deletando, cadastrando ou editando os **Usuarios**, **Desenvolvedores**
 e **Jogos**.

- **Campos Principais**:
- 
  - tb_administradores: 
    - `idAdm` (tipo: chave primária, única e auto incremental)
    - `fk_usuario` (tipo: chave estrangeira, ligação das tabelas de usuario e administrador)
  - tb_bibliotecas:
    - `idBiblioteca` (tipo: chave primária, unica e auto incremental)
    - `fk_usuairo` (tipo: chave estrangeira, ligação das tabelas de usuario e biblioteca)
    - `fk_itens` (tipo: chave estrangeira, ligação das tabelas de itens e biblioteca)
  - tb_carrinhos:
    - `idCarrinhos` (tipo: chave primária, unica e auto incremental)
    - `status` (tipo: texto de um digito (char), usado para indicar se o carrinho ja foi comprado ou ainda esta em pendente)
    - `fk_usuairo` (tipo: chave estrangeira, ligação das tabelas de usuario e carrinho)
  - tb_desenvolvedora:
    - `idDes` (tipo: chave primária, unica e auto incremental)
    - `cnpjDes` (tipo: texto (varchar) a ideia é criar boletos de compras ficticios usando o cnpj da empresa)
    - `nomeDes` (tipo: texto (varchar), nome de uma empresa ficticia)
    - `emailDes` (tipo: texto (varchar), email de uma empresa ficticia, usado também para login)
    - `senhaDes` (tipo: texto (varchar), senha de uma empresa ficticia, usado também para login)
  - tb_itens:
    - `idItens` (tipo: chave primária, unica e auto incremental)
    - `fk_jogos` (tipo: chave estrangeira, ligação das tabelas de jogos e itens)
    - `fk_carrinho` (tipo: chave estrangeira, ligação das tabelas de carrinhos e itens)
    - `fk_biblioteca` (tipo: chave estrangeira, ligação das tabelas de biblioteca e itens)
  - tb_jogos:
    - `idJogo` (tipo: chave primária, unica e auto incremental)
    - `nomeJogo` (tipo: texto (varchar), nome de um jogo ficticio)
    - `imgjogo` (tipo: texto (varchar), usado para indicar os diretórios das imagens dos jogos)
    - `descricaoJogo` (tipo: texto (varchar), usado para descrever os jogos)
    - `precoJogo` (tipo: numero com virgula (float, indicara o preco do jogo)
    - `idadeCategJogo` (tipo: valor inteiro (int), indicara a idade indicada para jogar do jogo)
    - `categoriaJogo` (tipo: texto (varchar), usado para pesquisar no site os jogos da categoria)
    - `fk_desenvolvedora` (tipo: chave estrangeira, ligação das tabelas de desenvolvedora e jogo)
  -  tb_usuario:
    - `idDes` (tipo: chave primária, unica e auto incremental)
    - `cpfUsu` (tipo: texto (varchar) a ideia é pagar boletos de compras ficticias usando o cpf do usuario)
    - `nomeUsu` (tipo: texto (varchar), nome de um usuario)
    - `emailUsu` (tipo: texto (varchar), email de um usuario, usado também para login)
    - `senhaUsu` (tipo: texto (varchar), senha de um usuario, usado também para login)


---
