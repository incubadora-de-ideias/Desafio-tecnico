import { Link } from "react-router-dom";
import style from "../style/listOpcoces.module.css";
function ListOpcoces({tipo}) {
  return (
    <div className={style.container}>
      <ul>
        <li>
          <Link to={"/aluno"}>Aluno</Link>
        </li>
        <li>
          <Link to={"/nota"}>Nota</Link>
        </li>
        {tipo ==! "admin" && (
          <>
            <li>
              <Link to={"/boletim"}>Boletim</Link>
            </li>
            <li>
              <Link to={"/gestao"}>Gestao</Link>
            </li>
          </>
        )}
      </ul>
    </div>
  );
}
export default ListOpcoces;