# example.py

def greet(name):
    return f"Hello, {name}!"

if __name__ == "__main__":
    import sys
    name = sys.argv[1] if len(sys.argv) > 1 else "World"
    print(greet(name))
