import ListOpcoces from "../components/listOpcoces";
import style from "../style/user.module.css";
function User() {
  return (
    <div className={style.container}>
      <h1>User Page</h1>
      <ListOpcoces />
    </div>
  );
}

export default User;
