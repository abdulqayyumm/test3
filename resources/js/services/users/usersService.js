import http from "../instance";
import { handleHttpError } from "../httpHelpers";

export function getUsersList(page) {
  const params = {page};

  return http
    .get(`users`, { params })
    .then(res => {
      return res.data.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}

export function getUser(id) {
  return http
    .get(`users/${id}`)
    .then(res => {
      return res.data.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}

export function updateUser(id, data) {
  return http
    .put(`users/${id}`, data)
    .then(res => {
      return res.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}

export function exportUsers() {
  return http
    .get(`users/export`)
    .then(res => {
      return res.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}

export function fetchAndSaveUsers() {
  return http
    .post(`users/fetch/save`)
    .then(res => {
      return res.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}