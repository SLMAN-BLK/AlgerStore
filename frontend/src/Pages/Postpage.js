import { useToast } from "@chakra-ui/toast";

import {
    Box,
    Container,
    Tab,
    TabList,
    TabPanel,
    TabPanels,
    Tabs,
    
    Center} from "@chakra-ui/react";
  import {  Flex, Text, IconButton, Avatar } from '@chakra-ui/react';
  import { DeleteIcon } from '@chakra-ui/icons';
  import { useHistory } from "react-router";
  import { useState , useEffect } from "react";
  import { ChatState } from "../Context/ChatProvider";
  import axios from "axios";

  import {

    Link
  } from "react-router-dom";

  
  
  function Postepage() {
    const history = useHistory();
    
    const user = JSON.parse(localStorage.getItem("userInfo"));
    const [posts, setPosts] = useState([]);
    const toast = useToast();

    if(!user) history.push("/")


    

    /*const config = {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${user.token}`
        }
      };*/
  
      useEffect(() => {
        const fetchUserPosts = async () => {
          try {
            const response = await axios.get("/api/posts", {
              headers: {
                Authorization: `Bearer ${user.token}`,
              },
            });
            console.log(response.data)
            setPosts(response.data);
          } catch (error) {
            console.error("Error fetching user posts:", error);
          }
        };
    
        fetchUserPosts();
      }, [user.token]);


      
  
    return (
        <Center marginX="auto">
        <Box p={4} m={4} h="100vh" overflowY="scroll" bg="white" rounded="md" boxShadow="md" width="300px">
        {posts.map((post) => (
          <Box key={post._id} borderWidth="1px" borderRadius="lg" p={4} mb={4}>
            {/* Post Content */}
  
            <Flex mt={2} align="center">
              <Avatar size="sm" src={post.user.pic} alt={post.user.name} mr={2} />
              <Text fontWeight="bold">{post.user.name}</Text>
            </Flex>
            <Text>{post.content}</Text>
  
            
            
          </Box>
        ))}
      </Box>
      </Center>
    );
  }

  
  export default Postepage;
  