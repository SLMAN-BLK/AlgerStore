import "./App.css";
import Homepage from "./Pages/Homepage";
import { Route } from "react-router-dom";
import Chatpage from "./Pages/Chatpage";
import Postpage from "./Pages/Postpage";
import Profilepage from "./Pages/Profilepage";
import SideDrawer from "./components/miscellaneous/SideDrawer"
import { ChatState } from "./Context/ChatProvider";


function App() {

  const { user } = ChatState();

  return (
    <div className="App">
      <Route path="/" component={Homepage} exact />
      <>
      <div style={{ width: "100%" }}>
      {user ? <SideDrawer /> : <></>}
      <Route path="/chats" component={Chatpage} />
      <Route path="/pubs" component={Postpage} />
      <Route path="/profile" component={Profilepage} />
      </div>
      </>
    </div>
  );
}

export default App;
