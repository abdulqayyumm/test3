import http from "./instance";
import { handleHttpError } from "./httpHelpers";

export function loadMore (url) {
  return http
    .get(url)
    .then(res => {
      return res.data.data;
    })
    .catch(e => {
      return handleHttpError(e);
    });
}