## Context folders

This project keeps FE skills and rules in two folders — always read from them, not just this file:

- `.agents/` — frontend skill definitions (design taste, visual style, image-to-code, redesign rules, etc.)
- `.claude/` — project rules, settings, and the graphify skill

Rules:
- Before frontend/UI work, check `.agents/skills/` for a matching skill (e.g. design taste, minimalist UI, redesign guidance) and follow it.
- Check `.claude/CLAUDE.md` and `.claude/settings.json` for project-specific rules and config before making changes.
- Treat both folders as living context — re-check them when starting a new task, since skills/rules may be added or updated over time.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
