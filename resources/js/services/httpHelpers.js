export function handleHttpError (e) {
    if (e.response && e.response.data && e.response.data.message)
      return { error: e.response.data.message, status: e.response.status, ...e.response.data };
    // not sure if some of the error response.data have message instead of errors parameter
    // errors will always be in "errors" (plural, my bad for some that were in "error")
    if (e.response && e.response.data && e.response.data.errors)
      return { error: e.response.data.errors, status: e.response.status, ...e.response.data };
  
    if(e.response)
      return { error: 'Something went wrong!', status: e.response.status, ...e.response.data };
  
    return { error: 'Something went wrong!', status: 503 };
  }
  
  export function handleDetailedHttpError (e) {
    if (e.response && e.response.data && e.response.data.errors)
      return { error: e.response.data.errors, status: e.response.status, ...e.response.data };
  
    if(e.response)
      return { error: 'Something went wrong!', status: e.response.status, ...e.response.data };
  
    return { error: 'Something went wrong!', status: 503 };
  }