import ListOpcoces from "../components/listOpcoces";
import style from "../style/user.module.css";
function Aluno() {
  return (
    <div className={style.container}>
      <h1>Alunos</h1>
      <p>Gerencie os alunos aqui.</p>
      <form>
        <label>
          Nome:
          <input type="text" name="nome" />
        </label>
        <br />
        <label>
          Numero de Matrícula:
          <input type="number" name="idade" />
        </label>
        <br />
        <button type="submit">Adicionar Aluno</button>
      </form>
    </div>
  );
}

export default Aluno;
