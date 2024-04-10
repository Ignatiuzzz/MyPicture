import React, { useState, useEffect } from "react";
import Layout from "./../components/Layout/Layout";
import axios from "axios";
import { useParams, useNavigate } from "react-router-dom";
import "../styles/ProductDetailsStyles.css";

const DetallesDelProducto = () => {
  const params = useParams();
  const navigate = useNavigate();
  const [producto, setProducto] = useState({});
  const [productosRelacionados, setProductosRelacionados] = useState([]);

  // Detalles iniciales
  useEffect(() => {
    if (params?.slug) obtenerProducto();
  }, [params?.slug]);

  // Obtener producto
  const obtenerProducto = async () => {
    try {
      const { data } = await axios.get(
        `/api/v1/product/get-product/${params.slug}`
      );
      setProducto(data?.producto);
      obtenerProductosSimilares(data?.producto._id, data?.producto.categoria._id);
    } catch (error) {
      console.log(error);
    }
  };

  // Obtener productos similares
  const obtenerProductosSimilares = async (pid, cid) => {
    try {
      const { data } = await axios.get(
        `/api/v1/product/related-product/${pid}/${cid}`
      );
      setProductosRelacionados(data?.productos);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <Layout>
      <div className="row container detalles-del-producto">
        <div className="col-md-6">
          <img
            src={`/api/v1/product/product-photo/${producto._id}`}
            className="card-img-top"
            alt={producto.nombre}
            height="300"
            width={"350px"}
          />
        </div>
        <div className="col-md-6 detalles-del-producto-info">
          <h1 className="text-center">Detalles del Producto</h1>
          <hr />
          <h6>Nombre: {producto.nombre}</h6>
          <h6>Descripción: {producto.descripcion}</h6>
          <h6>
            Precio:
            {producto?.precio?.toLocaleString("es-ES", {
              style: "currency",
              currency: "EUR",
            })}
          </h6>
          <h6>Categoría: {producto?.categoria?.nombre}</h6>
          <button className="btn btn-secondary ms-1">AÑADIR AL CARRITO</button>
        </div>
      </div>
      <hr />
      <div className="row container productos-similares">
        <h4>Productos Similares ➡️</h4>
        {productosRelacionados.length < 1 && (
          <p className="text-center">No se encontraron productos similares</p>
        )}
        <div className="d-flex flex-wrap">
          {productosRelacionados?.map((p) => (
            <div className="card m-2" key={p._id}>
              <img
                src={`/api/v1/product/product-photo/${p._id}`}
                className="card-img-top"
                alt={p.nombre}
              />
              <div className="card-body">
                <div className="card-nombre-precio">
                  <h5 className="card-title">{p.nombre}</h5>
                  <h5 className="card-title card-precio">
                    {p.precio.toLocaleString("es-ES", {
                      style: "currency",
                      currency: "EUR",
                    })}
                  </h5>
                </div>
                <p className="card-text ">
                  {p.descripcion.substring(0, 60)}...
                </p>
                <div className="card-nombre-precio">
                  <button
                    className="btn btn-info ms-1"
                    onClick={() => navigate(`/product/${p.slug}`)}
                  >
                    Más detalles
                  </button>
                  {/* <button
                  className="btn btn-dark ms-1"
                  onClick={() => {
                    setCart([...cart, p]);
                    localStorage.setItem(
                      "cart",
                      JSON.stringify([...cart, p])
                    );
                    toast.success("Item Added to cart");
                  }}
                >
                  ADD TO CART
                </button> */}
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </Layout>
  );
};

export default DetallesDelProducto;
