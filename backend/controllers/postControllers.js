const asyncHandler = require("express-async-handler");
const mongoose = require('mongoose')
const Post = require("../models/postModel");
const User = require("../models/userModel");

//@description     Get all posts
//@route           GET /api/posts
//@access          protected
const allPosts = asyncHandler(async (req, res) => {
    try {
        const posts = await Post.find().populate('user', '-password'); 
        res.status(200).json(posts);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});


//@description     Get single user posts
//@route           GET /api/userPosts
//@access          protected
const userPosts = asyncHandler(async (req, res) => {
    try {
        const userId = req.user._id; 

        // Find posts by user ID
        const posts = await Post.find({ user: userId }).populate('user', '-password');

        res.status(200).json(posts);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});



//@description     create post
//@route           POST /api/posts
//@access          protected
const createPost = asyncHandler(async (req, res) => {
    const { content } = req.body;
    
    try {
        // Check if content is empty
        if (!content) {
            res.status(400).json({ message: 'Content field is required' });
            return;
        }

        const user = req.user; 

        // Create a new post
        const newPost = await Post.create({
            content,
            user: user._id, // Assign the post to the authenticated user
        });

        res.status(201).json(newPost);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});

//@description     delete post
//@route           DELETE /api/posts/:postId
//@access          protected
const deletePost = asyncHandler(async (req, res) => {
    const postId = req.params.postID;

    try {
        if (!mongoose.Types.ObjectId.isValid(postId)) {
            res.status(400).json({ message: 'Invalid postId' });
            return;
        }
        // Find the post by ID
        const post = await Post.findById(postId);

        // Check if the post exists
        if (!post) {
            res.status(404).json({ message: 'Post not found' });
            return;
        }

        // Check if the authenticated user is the owner of the post
        if (post.user.toString() !== req.user._id.toString()) {
            res.status(403).json({ message: 'Unauthorized: You do not have permission to delete this post' });
            return;
        }

        // Delete the post
        await post.remove();

        res.status(200).json({ message: 'Post deleted successfully' });
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
});


module.exports = { allPosts , userPosts , createPost , deletePost };


