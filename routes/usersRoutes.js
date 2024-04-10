import express from "express";
import {
  createUserController,
  deleteUserController,
  getAllUsersController,
  getUsersByRoleController,
  updateUserController,
  getSingleUserController
} from "../controllers/userController.js";
import { isAdmin, requireSignIn } from "../middlewares/authMiddleware.js";

const router = express.Router();

// Crear usuario (solo admin)
router.post("/create-user", requireSignIn, isAdmin, createUserController);

// Actualizar usuario (solo admin)
router.put("/update-user/:uid", requireSignIn, isAdmin, updateUserController);

// Obtener todos los usuarios
router.get("/get-users", getAllUsersController);

// Obtener un usuario
router.get("/getUser/:uid", getSingleUserController);

// Obtener usuarios por rol (admin o cliente)
router.get("/getUsers/role/:role", getUsersByRoleController);

// Eliminar usuario (solo admin)
router.delete("/delete-user/:uid", requireSignIn, isAdmin, deleteUserController);

export default router;
