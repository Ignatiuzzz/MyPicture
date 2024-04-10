import userModel from "../models/userModel.js"; // Cambiado de productModel
import dotenv from "dotenv";

dotenv.config();

// Crear un nuevo usuario
export const createUserController = async (req, res) => {
  try {
    const { name, email, password, phone, address, answer, role } = req.body;
    // Validación
    if (!name || !email || !password || !phone || !address || !answer) {
      return res.status(400).send({ error: "Todos los campos son requeridos" });
    }

    const user = new userModel({
      name,
      email,
      password, // Asegúrate de hashear esta contraseña en la implementación real
      phone,
      address,
      answer,
      role
    });

    await user.save();
    res.status(201).send({
      success: true,
      message: "Usuario creado exitosamente",
      user: {
        id: user._id,
        name: user.name,
        email: user.email,
        phone: user.phone,
        address: user.address,
        answer: user.answer,
        role: user.role
      }
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al crear el usuario",
      error: error.message,
    });
  }
};

// Obtener todos los usuarios
export const getAllUsersController = async (req, res) => {
  try {
    const users = await userModel.find({});
    res.status(200).send({
      success: true,
      message: "Todos los usuarios",
      users,
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al obtener los usuarios",
      error: error.message,
    });
  }
};

// Obtener usuarios por rol (Admins o Clientes)
export const getUsersByRoleController = async (req, res) => {
  try {
    console.log("sdadsa");
    const role = req.params.role; // 0 para clientes, 1 para admins
    const users = await userModel.find({ role: role });
    res.status(200).send({
      success: true,
      message: role === "1" ? "Todos los administradores" : "Todos los clientes",
      users,
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al obtener los usuarios por rol",
      error: error.message,
    });
  }
};

// Actualizar usuario
export const updateUserController = async (req, res) => {
  try {
    const { name, email, password, phone, address, answer, role } = req.body;
    const user = await userModel.findByIdAndUpdate(
      req.params.uid,
      { name, email, password, phone, address, answer, role },
      { new: true }
    );
    res.status(200).send({
      success: true,
      message: "Usuario actualizado correctamente",
      user,
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al actualizar el usuario",
      error: error.message,
    });
  }
};

// Eliminar usuario
export const deleteUserController = async (req, res) => {
  try {
    await userModel.findByIdAndDelete(req.params.uid);
    res.status(200).send({
      success: true,
      message: "Usuario eliminado exitosamente",
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al eliminar el usuario",
      error: error.message,
    });
  }
};
// Obtener un solo usuario por ID
export const getSingleUserController = async (req, res) => {
  try {
    console.log("dasda");
    const user = await userModel.findById(req.params.uid);
    if (!user) {
      return res.status(404).send({
        success: false,
        message: "Usuario no encontrado",
      });
    }
    res.status(200).send({
      success: true,
      message: "Usuario encontrado",
      user: {
        id: user._id,
        name: user.name,
        email: user.email,
        phone: user.phone,
        address: user.address,
        answer: user.answer,
        role: user.role,
        // Podrías decidir no enviar cierta información sensible como la contraseña
      },
    });
  } catch (error) {
    console.log(error);
    res.status(500).send({
      success: false,
      message: "Error al obtener el usuario",
      error: error.message,
    });
  }
};
