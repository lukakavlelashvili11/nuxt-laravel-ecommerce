export const errorHandler = (err) => {
    if(err.response && err.response.status == 422){
        return err.response.data.errors
      }
}