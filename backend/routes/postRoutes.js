const express = require("express");

const { protect } = require("../middleware/authMiddleware");
const {
    allPosts , userPosts , createPost , deletePost
  } = require("../controllers/postControllers");

const router = express.Router();


router.route("/posts").get(protect, allPosts);
router.route("/posts").post(protect, createPost);
router.route("/userPosts").get(protect, userPosts);
router.route("/posts/:postID").delete(protect, deletePost);

module.exports = router;


