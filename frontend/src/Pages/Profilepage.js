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

  
  
  
  function Profilepage() {
    const history = useHistory();
    const user = JSON.parse(localStorage.getItem("userInfo"));
    const [posts, setPosts] = useState([]);
    const toast = useToast();
    

    if(!user) history.push("/")
  
      useEffect(() => {
        const fetchUserPosts = async () => {
          try {
            const response = await axios.get("/api/userPosts", {
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


      const handleDeletePost = async (postId) => {
        try {
          await axios.delete(`/api/posts/${postId}`, {
            headers: {
              Authorization: `Bearer ${user.token}`,
            },
          });
    
          // Remove the deleted post from the local state
          setPosts((prevPosts) => prevPosts.filter((post) => post._id !== postId));
          toast({
            title: "post deleted",
            description: "post deleted",
            status: "success",
            duration: 5000,
            isClosable: true,
          });
        } catch (error) {
            toast({
                title: "post not deleted",
                description: "post not deleted",
                status: "error",
                duration: 5000,
                isClosable: true,
              });
          console.error(`Error deleting post with ID ${postId}:`, error);
        }
      };
  
    return (
        <Center marginX="auto">
        <Box p={4} m={4} h="100vh" overflowY="scroll" bg="white" rounded="md" boxShadow="md" width="300px">
        {posts.map((post) => (
          <Box key={post._id} borderWidth="1px" borderRadius="lg" p={4} mb={4}>
            {/* Post Content */}
            <Flex mt={2} justify="flex-end">
              <IconButton
                colorScheme="red"
                aria-label="Delete Post"
                icon={<DeleteIcon />}
                onClick={() => handleDeletePost(post._id)}
              />
            </Flex>
  
            
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

  
  export default Profilepage;
  