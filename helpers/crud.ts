import { $larafetch } from '~/helpers/larafetch';
import { stringify } from 'query-string';

export const makeCrud = (apiUrl: string) => ({
  getAll: (query: any = {}) => $larafetch.get(`${apiUrl}?${stringify(query)}`),

  getOne: (hash: any, query: any = {}) =>
    $larafetch.get(`${apiUrl}/${hash}?${stringify(query)}`),

  create: (payload: any) =>
    $larafetch.post(`${apiUrl}`, payload, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }),

  update: (hash: any, payload: any) => $larafetch.put(`${apiUrl}/${hash}`, payload),

  postUpdate: (id: any, payload: any) => $larafetch.post(`${apiUrl}/${id}`, payload),

  delete: (id: any, query: any = {}) =>
    $larafetch.delete(`${apiUrl}/${id}?${stringify(query)}`),

  uploadProfileImage: (hash: any, payload: FormData) =>
    $larafetch.post(`${apiUrl}/${hash}/upload-profile-image`, payload, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }),
});

export default makeCrud;