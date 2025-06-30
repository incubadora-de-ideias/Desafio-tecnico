import ListOpcoces from "../components/listOpcoces";
import style from "../style/user.module.css";
function Adm() {
  return (
    <div className={style.container}>
      <h1>ADM Page</h1>
      <ListOpcoces />
    </div>
  );
}

export default Adm;
