from pathlib import Path

base_dir = Path(__file__).parent

files = [
    base_dir / "KEN_ALL.CSV",
    base_dir / "JIGYOSYO.CSV"
]

encodings = [
    "utf-8",
    "cp932",
    "shift_jis",
    "euc_jp"
]

for file in files:
    print("=" * 50)
    print(file.name)

    with open(file, "rb") as f:
        data = f.read(10000)

    for encoding in encodings:
        try:
            text = data.decode(encoding)

            print(f"{encoding}: OK")

            # 最初の200文字をUnicodeエスケープで表示
            print(text[:200].encode("unicode_escape").decode())

        except UnicodeDecodeError:
            print(f"{encoding}: NG")