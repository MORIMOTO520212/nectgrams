import json

data = []

while True:
    try:
        kind = input("種類 person/group：")
        mid = ""
        date = input("日付 yyyy/mm/dd：")
        group = input("所属班：")
        contributor = input("入力者：")
        target = input("到達目標：")
        complete = int(input("達成度 0~100："))
        do = input("できたこと：")
        share = input("共有したいこと：")
        data.append({
            "kind": kind,
            "mid": "",
            "date": date,
            "group": group,
            "contributor": contributor,
            "target": target,
            "complete": complete,
            "do": do,
            "share": share
        })
    except KeyboardInterrupt:
        print("\ncomplete.")
        break

print(json.dumps(data, indent=4))