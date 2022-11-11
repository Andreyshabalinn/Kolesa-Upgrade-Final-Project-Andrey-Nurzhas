package main

import (
	"errors"
	"fmt"
	"io"
	"net/http"
	"os"
)

type Data struct {
	Name        string
	Description string
}

func save(w http.ResponseWriter, r *http.Request) {
	name := r.FormValue("Name")
	description := r.FormValue("Description")

	io.WriteString(w, name+"\n")
	io.WriteString(w, description)
}

func getRoot(w http.ResponseWriter, r *http.Request) {
	fmt.Printf("got / request\n")
	io.WriteString(w, "This is my website!\n")
}
func getHello(w http.ResponseWriter, r *http.Request) {
	fmt.Printf("got /hello request\n")
	io.WriteString(w, "Hello, HTTP!\n")
}

func main() {
	http.HandleFunc("/", getRoot)
	http.HandleFunc("/hello", save)

	err := http.ListenAndServe(":7777", nil)
	if errors.Is(err, http.ErrServerClosed) {
		fmt.Printf("server closed\n")
	} else if err != nil {
		fmt.Printf("error starting server: %s\n", err)
		os.Exit(1)
	}
}
